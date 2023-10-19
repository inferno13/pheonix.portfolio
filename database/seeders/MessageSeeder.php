<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = Ticket::all();

        foreach($tickets as $ticket) {
            Message::create([
                'ticket_id' => $ticket->id,
                'user_id' => $ticket->user->id,
                'text' => fake()->text()
            ]);
        }
    }
}
