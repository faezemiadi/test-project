<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Specialtie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentDetail>
 */
class AppointmentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory()->state(['status' => 1]),
            'client_id' => Client::factory(),
            'subject_id' => Specialtie::factory(),
            'duration' => fake()->numberBetween(0,60),
            'status' => fake()->randomElement([0,1]),
        ];
    }
}
