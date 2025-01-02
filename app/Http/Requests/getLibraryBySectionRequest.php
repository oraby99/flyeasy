<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\LibraryFileType;

class getLibraryBySectionRequest extends FormRequest
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
            'section_id'    => ['required', 'exists:library_sections,id'],
            'type'          => ['required', 'in:' . implode(',', LibraryFileType::getValues())]
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'section_id.required'   => 'exists_required',
                'section_id.exists'     => 'exists_not_found',
                'type.required'         => 'type_required',
                'type.in'               => 'type_not_found'
            ];
        }

        return [];
    }
}
