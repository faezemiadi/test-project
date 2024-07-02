<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'appointment_id' => 'required|integer|exists:appointments,id',
            'subject_id' => 'required|integer|exists:specialties,id',
            'duration' => 'nullable|numeric',
            'price' => 'nullable|numeric',
        ];
    }
}
