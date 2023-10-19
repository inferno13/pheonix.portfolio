<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Clients\WestWallet;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\WithDrawRequest;
use App\Models\DepositMethod;
use App\Models\Transactions\DepositTransaction;
use App\Models\Transactions\TransferTransaction;
use App\Models\Transactions\WithdrawalRequestTransaction;
use App\Models\Transactions\WithdrawalTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Throwable;

class WalletController extends BaseController
{
    protected $client = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('sanctum');
        $this->client = new WestWallet(
            config('services.westwallet.public'),
            config('services.westwallet.private')
        );
    }

    public function address(Request $request, $currency)
    {
        $user = auth('sanctum')->user();
        $depositMethod = DepositMethod::findOrFail($currency);
        $ipn_url = config('app.ipn_url') . '/webhook/address';
        $address = $this->client->generateAddress($depositMethod->ticker, $ipn_url, strval($user->id));
        return $this->sendResponse($address['address'], 'Address');
    }

    public function transfer(TransferRequest $request)
    {
        $user = auth('sanctum')->user();
        $userWallet = $user->wallet;

        $recipient = User::where('transfer_address', $request['account'])->first();
        $recipientWallet = $recipient->wallet;

        $userWallet->decrementBalance(TransferTransaction::create([
            'wallet_id' => $userWallet->id,
            'amount' => $request['amount'],
            'sender' => $user->id,
            'recipient' => $recipient->id,
            'status' => 'completed',
        ]));
        $recipientWallet->incrementBalance(TransferTransaction::create([
            'wallet_id' => $recipientWallet->id,
            'amount' => $request['amount'],
            'sender' => $user->id,
            'recipient' => $recipient->id,
            'status' => 'completed',
        ]));

        return $this->sendResponse(null, 'Transaction complete');
    }

    public function withdrawRequest(WithDrawRequest $request)
    {
        $user = auth('sanctum')->user();
        $wallet = $user->wallet;

        $wallet->decrementBalance(
            WithdrawalRequestTransaction::create([
                'amount' => $request['amount'],
                'status' => 'created',
                'address' => $request['address'],
                'wallet_id' => $wallet->id
            ])
        );
        return $this->sendResponse(array(), 'Withdrawal');
    }

    public function withdraw(Request $request, $id)
    {
        $withdrawalRequestTransaction = WithdrawalRequestTransaction::findOrFail($id);
        $withdrawalRequestTransaction->status = 'pending';
        $withdrawalRequestTransaction->save();
        // $result = $this->client->createWithdrawal('USDT', $withdrawalTransaction->amount, $withdrawalTransaction->address);

        // WithdrawalTransaction::create([
        //     'westwallet_id' => $result['id'],
        //     'amount' => $result['amount'],
        //     'address' => $result['address'],
        //     'dest_tag' => $result['dest_tag'],
        //     'status' => $result['status'],
        //     'blockchain_confirmations' => $result['blockchain_confirmations'],
        //     'fee' => $result['fee'],
        //     'blockchain_hash' => $result['blockchain_hash'],
        // ]);
            
        // return $this->sendResponse($result, 'Withdrawal Complete');
        return $this->sendResponse($withdrawalRequestTransaction, 'Withdrawal Complete');
    }

    private function getWithdrawalTranscations()
    {
        $user = auth('sanctum')->user();
        $operations = $user->wallet->withdrawalTransactions->sortByDesc('updated_at')->values()->groupby('westwallet_id');
        foreach ($operations as $oper) {
            $last_status = $oper->first()->status;
            if ($last_status != 'network_error' && $last_status != 'completed') {
                try {
                    $result = $this->client->transactionInfo($oper[0]->westwallet_id);
                    if ($result['status'] == 'completed') {
                        WithdrawalTransaction::create([
                            'westwallet_id' => $result['id'],
                            'amount' => $result['amount'],
                            'address' => $result['address'],
                            'dest_tag' => $result['dest_tag'],
                            'status' => $result['status'],
                            'blockchain_confirmations' => $result['blockchain_confirmations'],
                            'fee' => $result['fee'],
                            'blockchain_hash' => $result['blockchain_hash'],
                        ]);
                    }
                } catch (Throwable $e) {
                    report($e);
                }
            }
        }
        $transactions = $operations = $user->wallet->withdrawalTransactions->sortByDesc('updated_at')->values();
        return $transactions;
    }

    public function withdrawalTransactions()
    {
        return $this->sendResponse($this->getWithdrawalTranscations(), 'Withdrawal Transactions');
    }

    private function getDepositTransactions()
    {
        $user = auth('sanctum')->user();
        $transactions = $user->wallet->depositTransactions->sortByDesc('updated_at')->values();
        return $transactions;
    }

    public function allDepositTransactions()
    {
        $transactions = DepositTransaction::with('wallet.user:id,name', 'wallet:id,user_id')
            ->select('id', 'status', 'wallet_id', 'currency', 'amount', 'updated_at')
            ->orderBy('updated_at', 'DESC')->get();
        return $this->sendResponse($transactions, 'All deposit Transactions');
    }

    public function depositTransactions()
    {
        return $this->sendResponse($this->getDepositTransactions(), 'Deposit Transactions');
    }

    private function getTransferTransactions()
    {
        $user = auth('sanctum')->user();
        $sent = $user->wallet->sentTransferTransactions->sortByDesc('updated_at');
        foreach ($sent as &$item) {
            $item['sender'] = 'me';
            $item['recipient'] = User::findOrFail($item['recipient'])->name;
        }
        $received = $user->wallet->receivedTransferTransactions->sortByDesc('updated_at');
        foreach ($received as &$item) {
            $item['sender'] = User::findOrFail($item['sender'])->name;
            $item['recipient'] = 'me';
        }
        $transactions = $sent->merge($received)->sortByDesc('updated_at')->map(function ($item) {
            return $item->only(['sender', 'recipient', 'amount', 'status', 'updated_at']);
        })->values()->all();
        return $transactions;
    }

    public function transferTransactions()
    {
        return $this->sendResponse($this->getTransferTransactions(), 'Transfer Transactions');
    }

    public function mapTransactionType($transactionType) {
        switch ($transactionType) {
            case \App\Models\Transactions\DepositTransaction::class:
                return 'deposit';
                break;
            case \App\Models\Transactions\TransferTransaction::class:
                return 'transfer';
                break;
            case \App\Models\Transactions\WithdrawalTransaction::class:
                return 'withdraw';
                break;
            default:
                return 'unknown';
        }
    }

    public function withdrawalRequestTransactions()
    {
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        $transactions = WithdrawalRequestTransaction::with('wallet.user:id,name', 'wallet:id,user_id')
            ->where('status', 'created')
            ->select('id', 'amount', 'wallet_id', 'status', 'address', 'updated_at')
            ->orderBy('updated_at', 'DESC')->get();
        return $this->sendResponse($transactions, 'Withdrawal Request Transactions');
    }

    public function history()
    {
        $user = auth('sanctum')->user();
        $_transactions = $user->wallet->walletLedgers->map->only(['amount', 'updated_at', 'transaction_type'])->sortByDesc('updated_at')->values()->toArray();
        $transactions = array_map(function($item) {
            return array(
                'amount' => $item['amount'],
                'updated_at' => $item['updated_at'],
                'transaction_type' => $this->mapTransactionType($item['transaction_type'])
            );
        }, $_transactions);
        return $this->sendResponse($transactions, 'History');
    }
}
