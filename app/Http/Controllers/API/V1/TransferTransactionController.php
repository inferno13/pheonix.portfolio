<?php

namespace App\Http\Controllers\API\V1;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use App\Http\Resources\TransferTransactionResource;
use App\Models\Notification;
use App\Models\Transactions\TransferTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransferTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return TransferTransactionResource::collection(
            TransferTransaction::where('sender_id', $user->wallet->id)
                ->orWhere('recipient_id', $user->wallet->id)
                ->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransferRequest $request)
    {
        $user = auth('sanctum')->user();
        $userWallet = $user->wallet;

        $recipient = User::where('transfer_address', $request['account'])->first();
        $recipientWallet = $recipient->wallet;

        // had to create two transactions for two users
        $userTransaction = TransferTransaction::create([
            'amount' => $request['amount'],
            'wallet_id' => $userWallet->id,
            'sender_id' => $user->id,
            'recipient_id' => $recipient->id,
            'status' => 'completed',
        ]);
        $userWallet->decrementBalance($userTransaction);

        $recipientTransaction = TransferTransaction::create([
            'amount' => $request['amount'],
            'wallet_id' => $recipientWallet->id,
            'sender_id' => $user->id,
            'recipient_id' => $recipient->id,
            'status' => 'completed',
        ]);
        $recipientWallet->incrementBalance($recipientTransaction);
        return new TransferTransactionResource($userTransaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
