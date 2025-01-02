<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateHisPlanRequest extends FormRequest
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
            'plan_id' => ['required', 'exists:plans,id']
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'plan_id.required'  => 'plan_id_required',
                'plan_id.exists'    => 'plan_id_not_found'
            ];
        }

        return [];
    }
}
