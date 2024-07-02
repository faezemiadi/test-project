<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'mobile' => fake()->phoneNumber(),
            'password' => Hash::make('password'),
            'gender' => fake()->randomElement([0,1]),
        ];
    }
}
