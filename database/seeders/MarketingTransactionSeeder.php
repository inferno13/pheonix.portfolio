<?php

namespace Database\Seeders;

use App\Models\Transactions\MarketingTransaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user) {
            $transaction = MarketingTransaction::create([
                'wallet_id' => $user->wallet->id,
                'amount' => 200,
                'status' => 'completed'
            ]);
            $user->wallet->incrementBalance($transaction);
        }
    }
}
