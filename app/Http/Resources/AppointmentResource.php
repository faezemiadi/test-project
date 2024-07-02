<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use App\Models\Consultant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{ 
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'day_of_week' => $this->nameWeek,
            'start_time' => Carbon::parse($this->start_time)->format('H:i'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'consultant' => new ConsultantResource($this->whenLoaded('consultant')),
        ];
    }
}
