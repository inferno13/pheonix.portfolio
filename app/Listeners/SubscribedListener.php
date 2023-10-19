<?php

namespace App\Listeners;

use App\Events\Subscribed;
use App\Models\Campaign;
use App\Models\QuickBonus;
use App\Models\Transactions\BonusTransaction;
use App\Models\Transactions\MarketingTransaction;
use App\Models\User;

class SubscribedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    private $subscription;

    private function setQuickBonus() {
        $quick_bonus = QuickBonus::where('user_id', $this->subscription->user()->id)->first();
        if(!$quick_bonus && $this->subscription->user()->hasSubscriptionWithQuickBonus()) {
            QuickBonus::create([
                'user_id' => $this->subscription->user()->id,
                'status' => 'created'
            ]);
        }
    }

    private function giveMoney($sponsor) {
        if ($sponsor) {
            $parent = User::find($sponsor->parent_id);
            $level = $sponsor->level;
            if ($level <= $parent->maxMarketingLevel()) {
                $level_interest = Campaign::getLevel($level);
                $amount = $this->subscription->amount * $level_interest;
                $marketing_transaction = MarketingTransaction::create([
                    'wallet_id' => $parent->wallet->id,
                    'amount' => $amount,
                    'status' => 'completed'
                ]);
                $parent->wallet->incrementBalance($marketing_transaction);
                
                $quick_bonus = $parent->getQuickBonus();
                if ($quick_bonus) {
                    $bonus_transaction = BonusTransaction::create([
                        'wallet_id' => $parent->wallet->id,
                        'amount' => $quick_bonus,
                        'status' => 'completed'
                    ]);
                    $qb = QuickBonus::where('user_id', $parent->id)->first();
                    $qb->status = 'completed';
                    $qb->save();
                    $parent->wallet->incrementBalance($bonus_transaction);
                }
                $sponsor_of_sponsor = $parent->sponsor;
                $this->giveMoney($sponsor_of_sponsor);
            }
        }
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Subscribed  $event
     * @return void
     */
    public function handle(Subscribed $event)
    {
        // $this->setQuickBonus($event->subscription);
        $this->subscription = $event->subscription;
        $this->setQuickBonus();
        $this->giveMoney($event->subscription->user()->sponsor);
    }
}
