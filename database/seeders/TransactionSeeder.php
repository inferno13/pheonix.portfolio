<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transactions\DepositTransaction;
use App\Models\Transactions\TransferTransaction;
use App\Models\Transactions\WithdrawalTransaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user_1) {
            $amount = count($users) * 200;
            $user_1->wallet->incrementBalance(
                DepositTransaction::create([
                    'amount' => $amount,
                    'wallet_id' => $user_1->wallet->id,
                    'address' => '123123123123123123123123123123123123',
                    'deposit_method_id' => 1,
                    'status' => 'completed',
                ])
            );
            foreach ($users as $user_2) {
                $transfer_transaction = TransferTransaction::create([
                    'amount' => 50.00,
                    'wallet_id' => $user_1->wallet->id,
                    'sender_id' => $user_1->id,
                    'recipient_id' => $user_2->id,
                    'status' => 'completed',
                ]);
                $user_1->wallet->decrementBalance($transfer_transaction);
                $user_2->wallet->incrementBalance($transfer_transaction);
            }
        }
    }
}
