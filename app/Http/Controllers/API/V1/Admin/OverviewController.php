<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Clients\WestWallet;
use App\Http\Controllers\Controller;
use App\Http\Resources\OverviewResource;
use App\Http\Resources\SubscriptionTransactionResource;
use App\Http\Resources\UserResource;
use App\Models\Ticket;
use App\Models\Transactions\BonusTransaction;
use App\Models\Transactions\SubscriptionTransaction;
use App\Models\Transactions\TransferTransaction;
use App\Models\Transactions\WithdrawTransaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $user_count = $users->count();
        $subscribed_users = $users->filter(function ($user) {
            return $user->isSubscribed();
        });
        $subscribed_count = $subscribed_users->count();
        $user_balances = Wallet::sum('raw_balance');
        $ww_client =new WestWallet(
            config('services.westwallet.public'),
            config('services.westwallet.private')
        );
        $westwallet_balance = $ww_client->walletBalance('USDT')['balance'];
        $withdraw_amount = WithdrawTransaction::where('status', 'created')->sum('amount');
        $transfer_amount = TransferTransaction::sum('amount');

        $subscriptions = SubscriptionTransactionResource::collection(SubscriptionTransaction::all());
        $tickets = Ticket::all();
        $bonus_amount = BonusTransaction::sum('amount');

        $sellers = User::all()->map(function ($user) {
            $marketing =  $user->marketing();
            return [
                'user' => new UserResource($user),
                'partners_count' => $user->partners()->count(),
                'value' => $marketing['first_pull_value'] + $marketing['second_pull_value']
            ];
        })->toArray();

        usort($sellers, function ($item1, $item2) {
            return $item2['value'] <=> $item1['value'];
        });

        $sellers = array_slice($sellers, 0, 5);

        $data = [
            'user_count' => $user_count,
            'user_balances' => $user_balances,
            'westwallet_balance' => $westwallet_balance,
            'subscribed_count' => $subscribed_count,
            'withdraw_amount' => $withdraw_amount,
            'transfer_amount' => $transfer_amount,
            'tickets' => $tickets,
            'sellers' => $sellers,
            'subscriptions' => $subscriptions,
            'bonus_amount' => $bonus_amount,
        ];
        return response()->json($data);
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
