<?php

namespace Database\Factories;

use App\Models\Consultant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'consultant_id' => Consultant::factory(),
            'day_of_week' => fake()->randomElement([1,2,3,4,5,6]),
            'start_time' => fake()->time('H:i'),
            'end_time' => fake()->time('H:i'),
            'status' => fake()->randomElement([0,1]),
            'date' => fake()->dateTimeBetween('-30 Days','+30 Days')
        ];
    }
}
