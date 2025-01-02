<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateLibrarySectionRequest extends FormRequest
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
            'name'  => ['required', 'string', 'min:3', 'max:255', 'unique:library_sections,name']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => __('custom-validation.name-required'),
            'name.string'       => __('custom-validation.name-string'),
            'name.min'          => __('custom-validation.name-min-3'),
            'name.max'          => __('custom-validation.name-max-255'),
            'name.unique'       => __('custom-validation.name-exists')
        ];
    }
}
