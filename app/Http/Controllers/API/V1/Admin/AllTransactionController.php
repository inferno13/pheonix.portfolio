<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transactions\BonusTransaction;
use App\Models\Transactions\DepositTransaction;
use App\Models\Transactions\MarketingTransaction;
use App\Models\Transactions\SubscriptionTransaction;
use App\Models\Transactions\TransferTransaction;
use App\Models\Transactions\WithdrawTransaction;
use App\Support\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AllTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonus_transactions = BonusTransaction::all();
        $deposit_transactions = DepositTransaction::all();
        $marketing_transactions = MarketingTransaction::all();
        $subscription_transactions = SubscriptionTransaction::all();
        $transfer_transactions = TransferTransaction::all();
        $withdraw_transactions = WithdrawTransaction::all();

        $data = $bonus_transactions->concat($deposit_transactions)
            ->concat($marketing_transactions)
            ->concat($subscription_transactions)
            ->concat($transfer_transactions)
            ->concat($withdraw_transactions);
        
        return TransactionResource::collection(Paginator::paginate($data, 10));
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
