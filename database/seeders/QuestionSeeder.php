<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = QuestionCategory::all();

        foreach($categories as $category) {
            foreach(range(0, 10) as $index) {
                Question::create([
                    'question_category_id' => $category->id,
                    'question' => fake()->text(),
                    'answer' => fake()->text()
                ]);
            }
        }
    }
}
