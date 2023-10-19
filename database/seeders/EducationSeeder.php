<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Education;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $categories = Category::all();
        foreach ($users as $user) {
            foreach ($categories as $category) {
                $education = Education::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);
                Lesson::create([
                    'number' => 1,
                    'next' => 2,
                    'is_unlocked' => true,
                    'video_id' => 1,
                    'education_id' => $education->id
                ]);
                Lesson::create([
                    'number' => 2,
                    'next' => 3,
                    'video_id' => 2,
                    'education_id' => $education->id
                ]);
                Lesson::create([
                    'number' => 3,
                    'video_id' => 3,
                    'education_id' => $education->id
                ]);
            }
        }

    }
}
