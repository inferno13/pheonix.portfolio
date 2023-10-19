<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $faker = \Faker\Factory::create('ru_RU');
        foreach($users as $user) {
            Ticket::create([
                'ticket_category_id' => 1,
                'user_id' => $user->id,
                'title' => $faker->text(10),
                'description' => $faker->text(50),
                'status' => 'awaiting_support'
            ]);
        }
    }
}
