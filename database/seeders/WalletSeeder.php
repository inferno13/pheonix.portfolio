<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('wallets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $users = User::all();
        foreach($users as $user) {
            $id = $user->id;
            Wallet::create([
                'user_id' => $id
            ]);
        }
    }
}
