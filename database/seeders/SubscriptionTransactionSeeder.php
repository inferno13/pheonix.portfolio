<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transactions\SubscriptionTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubscriptionTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $product = Product::findOrFail(3);
        foreach ($users as $user) {
            $user->wallet->decrementBalance(
                SubscriptionTransaction::create([
                    'product_id' => $product->id,
                    'wallet_id' => $user->wallet->id,
                    'amount' => $product->price,
                    'status' => 'completed',
                    'product_key' => Str::uuid(),
                    'expires_at' => Carbon::now()->addMonths($product->period),
                ])
            );
        }
    }
}
