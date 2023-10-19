<?php

namespace Database\Seeders;

use App\Models\Transactions\BonusTransaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sum = 10000;
        $users = User::all();
        foreach($users as $user) {
            $pull_status = $user->pull_status();
            $wallet = $user->wallet;
            if ($pull_status === 2) {
                $transaction = BonusTransaction::create([
                    'amount' => $sum * 0.02,
                    'wallet_id' => $wallet->id,
                    'status' => 'completed'
                ]);
                $wallet->incrementBalance($transaction);
            }
            if ($pull_status === 1) {
                $transaction = BonusTransaction::create([
                    'amount' => $sum * 0.01,
                    'wallet_id' => $wallet->id,
                    'status' => 'completed'
                ]);
                $wallet->incrementBalance($transaction);
            }
        }
    }
}
