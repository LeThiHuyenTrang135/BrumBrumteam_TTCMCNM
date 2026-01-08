<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.exists' => 'Email not found',
            'code.required' => 'Verification code is required',
            'code.size' => 'Verification code must be 6 characters',
        ];
    }
}
