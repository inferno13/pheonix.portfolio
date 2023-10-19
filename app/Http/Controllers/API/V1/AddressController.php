<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Clients\WestWallet;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\Admin\DepositTransactionResource;
use App\Models\DepositMethod;
use App\Models\Transactions\DepositTransaction;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = auth('sanctum')->user();
        $depositMethod = DepositMethod::findOrFail($id);
        $ipn_url = config('app.ipn_url') . '/webhook/address';
        $client = new WestWallet(
            config('services.westwallet.public'),
            config('services.westwallet.private')
        );
        // create deposit transaction
        $transaction = DepositTransaction::create([
            'amount' => 0,
            'wallet_id' => $user->wallet->id,
            'currency' => $depositMethod->ticker,
            'status' => 'created',
        ]);
        $address = $client->generateAddress($depositMethod->ticker, $ipn_url, strval($transaction->id));
        $transaction->update((object)$address);
        $transaction->save();
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
