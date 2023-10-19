<?php

namespace Database\Seeders;

use App\Models\Telegram;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TelegramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_EN');
        $users = User::all();

        foreach($users as $user) {
            Telegram::create([
                'user_id' => $user->id,
                'name' => $faker->userName(),
            ]);
        }
    }
}
