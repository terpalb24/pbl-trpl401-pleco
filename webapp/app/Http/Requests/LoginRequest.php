<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email:rfc,dns',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:64',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,64}$/'
            ],
        ];
    }

    /**
     * Websitenya minta maaf kalau usernya salah.
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'Maaf, email tidak boleh kosong',
            'email.email'       => 'Maaf, format email Anda salah',
            'password.required' => 'Maaf, password tidak boleh kosong',
            'password.min'      => 'Maaf, password minimal 8 karakter',
            'password.max'      => 'Maaf, password maksimal 64 karakter',
            'password.regex'    => 'Maaf, kata sandi harus mengandung huruf kecil, huruf besar, angka, dan simbol'
        ];
    }
}
