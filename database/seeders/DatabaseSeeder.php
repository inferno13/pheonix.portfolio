<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\QuestionCategory;
use App\Models\Transactions\BonusTransaction;
use App\Models\Transactions\WithdrawTransaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CampaignSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            UserSeeder::class,
            TelegramSeeder::class,
            WalletSeeder::class,
            DepositMethodSeeder::class,
            PartnerSeeder::class,
            TransactionSeeder::class,
            WithdrawTransactionSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            SubscriptionTransactionSeeder::class,
            TicketCategorySeeder::class,
            TicketSeeder::class,
            MessageSeeder::class,
            NotificationSeeder::class,
            VideoSeeder::class,
            EducationSeeder::class,
            MarketingTransactionSeeder::class,
            QuestionCategorySeeder::class,
            QuestionSeeder::class,
            BonusTransactionSeeder::class,
        ]);
    }
}
