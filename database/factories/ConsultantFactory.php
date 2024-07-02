<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultant>
 */
class ConsultantFactory extends Factory
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
            'password' => fake()->password(),
            'profile_photo_path' => fake()->imageUrl(),
            'gmc_number' => fake()->numberBetween(111111,999999),
            'gender' => fake()->randomElement([0,1]),
        ];
    }
}
 