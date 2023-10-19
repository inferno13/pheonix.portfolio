<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BonusTransactionResource;
use App\Http\Resources\MonthlyBonusResource;
use App\Models\Campaign;
use App\Models\MonthlyBonus;
use App\Models\Transactions\BonusTransaction;
use App\Models\User;
use App\Support\Paginator;
use Illuminate\Http\Request;

class MonthlyBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->filter(function($item) {
            return $item->pull_status() > 0;
        });
        return MonthlyBonusResource::collection(Paginator::paginate($users, 10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $amount = (int) $request->amount;
        // $users = User::all();
        // foreach($users as $user) {
        //     $pull_status = $user->pull_status();
        //     $wallet = $user->wallet;
        //     if ($pull_status === 2) {
        //         $transaction = BonusTransaction::create([
        //             'amount' => $amount * 0.02,
        //             'wallet_id' => $wallet->id,
        //             'status' => 'completed'
        //         ]);
        //         $wallet->incrementBalance($transaction);
        //     }
        //     if ($pull_status === 1) {
        //         $transaction = BonusTransaction::create([
        //             'amount' => $amount * 0.01,
        //             'wallet_id' => $wallet->id,
        //             'status' => 'completed'
        //         ]);
        //         $wallet->incrementBalance($transaction);
        //     }
        // }
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
        $user = User::findOrFail($id);
        if ($user->pull_status() === 0 || $user->hasMonthlyBonus()) {
            abort(403);
        }
        MonthlyBonus::create([
            'user_id' => $user->id
        ]);
        $amount = Campaign::profit() * Campaign::getPull($user->pull_status());
        $bonus = BonusTransaction::create([
            'wallet_id' => $user->wallet->id,
            'amount' => $amount,
            'status' => 'completed',
        ]);
        return new BonusTransactionResource($bonus);
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
