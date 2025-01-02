<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => __('custom-validation.email_required'),
            'password.required' => __('custom-validation.password_required'),
            'email.email'       => __('custom-validation.email_format_not_valid')
        ];
    }
}
