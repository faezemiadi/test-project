<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\Client;
use App\Models\Consultant;
use App\Models\Degree;
use App\Models\Specialtie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder 
{
    /**
     * Seed the application's database. 
     */
    public function run(): void
    {
        Consultant::factory()->
        has(Appointment::factory()->count(rand(1,5))->state(['status' => 0]),'appointments')->
        has(Specialtie::factory()->count('2'),'specialties')->has(Degree::factory()->count(1),'degrees')->count(10)->create();

        Client::factory()
        ->has(AppointmentDetail::factory()->count(rand(1,3)),'AppointmentDetails')->count(20)->create();
    } 
}
