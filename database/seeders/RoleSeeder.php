<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'user',
            'description' => 'User',
        ]);

        Role::create([
            'name' => 'admin',
            'description' => 'Admin'
        ]);

        Role::create([
            'name' => 'superadmin',
            'description' => 'Superadmin'
        ]);
    }
}
