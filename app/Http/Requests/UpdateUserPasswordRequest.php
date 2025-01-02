<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckUserOldPassword;

class UpdateUserPasswordRequest extends FormRequest
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
            'old_password'  => ['required', new CheckUserOldPassword],
            'new_password'  => ['required', 'string', 'min:6', 'max:30']
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'old_password.required' => 'old_password_required',
                'new_password.required' => 'new_password_required',
                'new_password.string'   => 'new_password_format_not_valid',
                'new_password.min'      => 'new_password_min_6',
                'new_password.max'      => 'new_password_max_30'
            ];
        }

        return [];
    }
}
