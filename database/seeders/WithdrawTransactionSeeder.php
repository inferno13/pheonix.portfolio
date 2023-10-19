<?php

namespace Database\Seeders;

use App\Models\Transactions\WithdrawTransaction;
use App\Models\User;
use App\Models\DepositMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->wallet->decrementBalance(
                WithdrawTransaction::create([
                    'amount' => 50.00,
                    'status' => 'created',
                    'deposit_method_id' => DepositMethod::where('ticker', 'USDTTRC')->first()->id,
                    'address' => 'TCFM1at6nLAo6yQ3MGRXyv8eqV45ox3TCQ',
                    'wallet_id' => $user->wallet->id
                ])
            );
        }
    }
}
