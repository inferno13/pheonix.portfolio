<?php

namespace App\Http\Controllers\API\V1;

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
        $user = auth('sanctum')->user();
        return WithdrawTransactionResource::collection(WithdrawTransaction::where('wallet_id', $user->wallet->id)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WithdrawRequest $request)
    {
        $user = auth('sanctum')->user();
        $wallet = $user->wallet;
        $transaction = WithdrawTransaction::create([
            'amount' => $request['amount'],
            'deposit_method' => DepositMethod::where('ticker', 'USDTTRC')->first()->id,
            'status' => 'created',
            'address' => $request['address'],
            'wallet_id' => $wallet->id,
        ]);
        $wallet->decrementBalance($transaction);

        return new WithdrawTransactionResource($transaction);
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
