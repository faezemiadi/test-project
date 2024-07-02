<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class LoginRegisterRequest extends FormRequest
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
        $currentRoute = Route::current();
 
        if($currentRoute->getName() === 'auth.loginRegister'){

            return [
            
                'register' => 'required|min:11|max:64|email',
                'guard' => 'required|in:client,consultant',

            ];
        }
        else{

            return [

                'otp' => 'required|min:6|max:6',
                'guard' => 'required|in:client,consultant'
            ];
        }

    }
}
