<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'gmc_number' => $this->gmc_number,
            'degrees' => DegreeResource::collection($this->whenLoaded('degrees')),
            'specialties' => SpecialtieResource::collection($this->whenLoaded('specialties')),
            'appointments' => AppointmentResource::collection($this->whenLoaded('appointments')),
            'active_appointments' => AppointmentResource::collection($this->whenLoaded('activeAppointments')),
            'reserved_appointments' => AppointmentDetailResource::collection($this->whenLoaded('reservedAppointments')),
            'token' => $this->when(($request->route()->getName() == 'auth.loginConfirm'),function (){
                
                return $this->createToken('client-token')->plainTextToken;
            }),
        ];
    }
}
