<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use App\Support\TransferAddressGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ru_RU');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $superadmin = User::create([
            'username' => $faker->userName(),
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('admin123'), // password
        ]);
        $superadmin->assignRole('admin');
        $superadmin->assignRole('superadmin');
        $admin = User::create([
            'username' => $faker->userName(),
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // password
        ]);
        $admin->assignRole('admin');
        User::create([
            'username' => $faker->userName(),
            'email' => 'test@test.com',
            'password' => Hash::make('test123'), // password
        ]);
        foreach(range(0, 20) as $index) {
            $fullname = explode(' ', $faker->name);
            User::create([
                'username' => $faker->userName(),
                'name' => $fullname[1],
                'surname' => $fullname[0],
                'patronymic' => $fullname[2],
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('user123'), // password
            ]);
        }
    }
}
