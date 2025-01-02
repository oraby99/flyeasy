<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\LibraryFileType;

class UpdateLibraryRequest extends FormRequest
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
            'file'          => ['sometimes', 'nullable', 'file', 'max:50000'],
            'type'          => ['required', 'in:' . implode(',', LibraryFileType::getValues())],
            'section_id'    => ['required', 'exists:library_sections,id']
        ];
    }

    public function messages(): array
    {
        return [
            'file.file'             => __('custom-validation.file-file'),
            'file.mimes'            => __('custom-validation.file-mimes'),
            'type.required'         => __('custom-validation.type-required'),
            'type.in'               => __('custom-validation.type-not-found'),
            'section_id.required'   => __('custom-validation.section-id-required'),
            'section_id.exists'     => __('custom-validation.section-id-not-found'),
        ];
    }
}
