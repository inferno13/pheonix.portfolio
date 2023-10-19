<?php

namespace Database\Seeders;

use App\Models\DepositMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('deposit_methods')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DepositMethod::create([
            'name' => 'Tether ERC-20',
            'ticker' => 'USDT',
            'network' => 'TRON',
            'confirmations' => 10,
            'min_receive' => 5,
            'logo' => '/media/logos/currencies/1.png',
            'fee' => 0.25
        ]);

        DepositMethod::create([
            'name' => 'Tether TRC-20',
            'ticker' => 'USDTTRC',
            'network' => 'TRON',
            'confirmations' => 19,
            'min_receive' => 0,
            'logo' => '/media/logos/currencies/2.png',
            'fee' => 0.25
        ]);

        DepositMethod::create([
            'name' => 'Bitcoin',
            'ticker' => 'USDTTRC',
            'network' => 'TRON',
            'min_receive' => 0.0005,
            'confirmations' => 3,
            'min_receive' => 0.0005,
            'logo' => '/media/logos/currencies/3.png',
            'fee' => 0
        ]);

        DepositMethod::create([
            'name' => 'Ethereum',
            'ticker' => 'ETH',
            'network' => 'TRON',
            'confirmations' => 10,
            'min_receive' => 0.01,
            'logo' => '/media/logos/currencies/4.png',
            'fee' => 0.001
        ]);

        DepositMethod::create([
            'name' => 'TRON',
            'ticker' => 'TRX',
            'network' => 'TRON',
            'confirmations' => 19,
            'min_receive' => 10,
            'logo' => '/media/logos/currencies/3.png',
            'fee' => 0
        ]);

        DepositMethod::create([
            'name' => 'Ripple',
            'ticker' => 'XRP',
            'network' => 'TRON',
            'confirmations' => 1,
            'min_receive' => 10,
            'logo' => '/media/logos/currencies/6.png',
            'fee' => 0
        ]);

        DepositMethod::create([
            'name' => 'Litecoin',
            'ticker' => 'LTC',
            'network' => 'TRON',
            'confirmations' => 3,
            'min_receive' => 0.01,
            'logo' => '/media/logos/currencies/7.png',
            'fee' => 0
        ]);
        
        DepositMethod::create([
            'name' => 'Dogecoin',
            'ticker' => 'DOGE',
            'network' => 'TRON',
            'confirmations' => 3,
            'min_receive' => 50,
            'logo' => '/media/logos/currencies/7.png',
            'fee' => 0
        ]);
    }
}
