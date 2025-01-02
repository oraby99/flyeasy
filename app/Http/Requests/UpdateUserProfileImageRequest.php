<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileImageRequest extends FormRequest
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
            'image' => ['required', 'file', 'mimes:jpeg,jpj,png', 'max:3000']
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'image.required'    => 'image_required',
                'image.file'        => 'image_must_be_file',
                'image.mimes'       => 'image_not_supported',
                'image.max'         => 'image_max_3_mb',
            ];
        }

        return [];
    }
}
