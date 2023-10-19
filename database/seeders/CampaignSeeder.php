<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::create([
            'name' => 'first_partners_count_target',
            'value' => 1, // 3
        ]);
        Campaign::create([
            'name' => 'second_partners_count_target',
            'value' => 1 // 3
        ]);
        Campaign::create([
            'name' => 'first_pull_target',
            'value' => 800 // 1600
        ]);
        Campaign::create([
            'name' => 'second_pull_target',
            'value' => 800 // 1600
        ]);
        Campaign::create([
            'name' => 'first_and_second_pull_target',
            'value' => 2500 // 5000
        ]);
        Campaign::create([
            'name' => 'quick_bonus_value_target',
            'value' => 50 // 2500
        ]);
        Campaign::create([
            'name' => 'quick_bonus_value_time',
            'value' => 31 // days
        ]);
        Campaign::create([
            'name' => 'quick_bonus_value_interest',
            'value' => 0.1 // percentage
        ]);
        // Levels
        Campaign::create([
            'name' => 'level_1',
            'value' => 0.2
        ]);
        Campaign::create([
            'name' => 'level_2',
            'value' => 0.1
        ]);
        Campaign::create([
            'name' => 'level_3',
            'value' => 0.05
        ]);
        Campaign::create([
            'name' => 'level_4',
            'value' => 0.04
        ]);
        Campaign::create([
            'name' => 'level_5',
            'value' => '0.03'
        ]);
        Campaign::create([
            'name' => 'level_6',
            'value' => 0.02
        ]);
        Campaign::create([
            'name' => 'level_7',
            'value' => 0.02
        ]);
        Campaign::create([
            'name' => 'level_8',
            'value' => 0.02
        ]);
        Campaign::create([
            'name' => 'level_9',
            'value' => 0.01
        ]);
        Campaign::create([
            'name' => 'level_10',
            'value' => 0.01
        ]);
        Campaign::create([
            'name' => 'profit',
            'value' => 1000000
        ]);
        Campaign::create([
            'name' => 'pull_1',
            'value' => 0.01
        ]);
        Campaign::create([
            'name' => 'pull_2',
            'value' => 0.02
        ]);
        Campaign::create([
            'name' => 'pull_3',
            'value' => 0.03
        ]);
    }
}
