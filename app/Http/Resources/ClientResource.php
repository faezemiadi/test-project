<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AppointmentDetailResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array 
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'appointments' => AppointmentDetailResource::collection($this->whenLoaded('AppointmentDetails')),
            'token' => $this->when(($request->route()->getName() == 'auth.loginConfirm'),function (){
                
                return $this->createToken('client-token')->plainTextToken;
            }),
        ];
    }
}
