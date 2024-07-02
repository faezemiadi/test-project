<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ 
            
            'duration' => $this->duration,
            'price' => $this->price,
            'status' => $this->status,
            'appointment' => new AppointmentResource($this->appointment),
            'client' => new ClientResource($this->client),
            'subject' => new SpecialtieResource($this->subject),
        ];
    }
}
