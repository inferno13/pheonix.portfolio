<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Clients\WestWallet;
use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Http\Resources\WithdrawTransactionResource;
use App\Models\Transactions\WithdrawTransaction;
use Illuminate\Http\Request;

class WithdrawTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WithdrawTransactionResource::collection(WithdrawTransaction::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new WestWallet(
            config('services.westwallet.public'),
            config('services.westwallet.private')
        );
        $withdraw_transaction = WithdrawTransaction::findOrFail($request['id']);
        $withdraw_transaction->status = 'completed';
        $withdraw_transaction->save();
        // $result = $client->createWithdrawal('USDTTRC', $withdraw_transaction->amount, $withdraw_transaction->address);
        return new WithdrawTransactionResource($withdraw_transaction);
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
