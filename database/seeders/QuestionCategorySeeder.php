<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(0, 10) as $index) {
            QuestionCategory::create([
                'name' => fake()->text(20)
            ]);
        }
    }
}
