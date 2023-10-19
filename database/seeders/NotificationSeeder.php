<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Transactions\DepositTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = DepositTransaction::all();

        foreach($transactions as $transaction) {
            Notification::create([
                'user_id' => $transaction->wallet->user->id,
                'detail_id' => $transaction->id,
                'detail_type' => DepositTransaction::class,
                'name' => DepositTransaction::tableName()
            ]);
        }
    }
}
