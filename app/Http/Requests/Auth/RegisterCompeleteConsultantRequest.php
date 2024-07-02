<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;


class RegisterCompeleteConsultantRequest extends FormRequest
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
            
            'first_name' => 'required|min:2|max:255|regex:/^[a-zA-Z0-9آ-یء ]+$/u',
            'last_name' => 'required|min:2|max:255|regex:/^[a-zA-Z0-9آ-یء-ئ ]+$/u',
            'email' => ['nullable','email',Rule::unique('consultants')->ignore(auth()->user()->id)],
            'mobile' => ['required','digits:11',Rule::unique('consultants')->ignore(auth()->user()->id)],
            'password' => ['required_with:password_confirmation',Password::min(8)->mixedCase()->letters()->numbers(),'confirmed'],
            'gender' => 'required|in:0,1',
            'gmc_number' => 'required|integer',
            'profile_photo_path' => 'nullable|string'
        ];
    }
}
