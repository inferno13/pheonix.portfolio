<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketCategory::create([
            'name' => 'Test Ticket Category'
        ]);
        TicketCategory::create([
            'name' => 'Second Test Ticket Category'
        ]);
    }
}
