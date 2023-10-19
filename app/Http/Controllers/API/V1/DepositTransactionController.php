<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Clients\WestWallet;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepositTransactionResource;
use App\Models\DepositMethod;
use App\Models\Transactions\DepositTransaction;
use Illuminate\Http\Request;

class DepositTransactionController extends Controller
{

    protected $client = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new WestWallet(
            config('services.westwallet.public'),
            config('services.westwallet.private')
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return DepositTransactionResource::collection(DepositTransaction::where('wallet_id', $user->wallet->id)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('sanctum')->user();
        $depositMethod = DepositMethod::findOrFail((int)$request['deposit_method_id']);
        $ipn_url = config('app.ipn_url') . '/webhook/address';
        $transaction = DepositTransaction::create([
            'amount' => 0,
            'wallet_id' => $user->wallet->id,
            'deposit_method_id' => $depositMethod->id,
            'status' => 'pending'
        ]);
        $address = $this->client->generateAddress($depositMethod->ticker, $ipn_url, strval($transaction->id));
        $transaction->update([
            'address' => $address['address']
        ]);
        $transaction->save();
        return new DepositTransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = DepositTransaction::findOrFail($id);
        return new DepositTransactionResource($transaction);
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
