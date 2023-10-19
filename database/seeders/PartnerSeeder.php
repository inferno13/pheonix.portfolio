<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_1 = User::findOrFail(1);
        $user_2 = User::findOrFail(2);
        $user_3 = User::findOrFail(3);
        $user_4 = User::findOrFail(4);

        $user_5 = User::findOrFail(5);
        $user_6 = User::findOrFail(6);
        $user_7 = User::findOrFail(7);
        $user_8 = User::findOrFail(8);
        $user_9 = User::findOrFail(9);
        $user_10 = User::findOrFail(10);

        Partner::create([
            'parent_id' => $user_1->id,
            'child_id' => $user_2->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_2->id,
            'child_id' => $user_3->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_1->id,
            'child_id' => $user_4->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_1->id,
            'child_id' => $user_5->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_1->id,
            'child_id' => $user_6->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_1->id,
            'child_id' => $user_7->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_2->id,
            'child_id' => $user_8->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_2->id,
            'child_id' => $user_9->id,
            'level' => 1
        ]);

        Partner::create([
            'parent_id' => $user_2->id,
            'child_id' => $user_10->id,
            'level' => 1
        ]);
    }
}
