<?php

namespace Database\Factories;

use App\Models\Country;
use App\Support\Generators\InviteCodeGenerator;
use App\Support\Generators\TransferAddressGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->name(),
            'surname' => $faker->name(),
            'patronymic' => $faker->name(),
            'username' => $faker->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('user123'), // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
