<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\LanguageEnum;

class UpdateUserProfileDataRequest extends FormRequest
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
            'name'          => ['required', 'string', 'min:3', 'max:50'],
            'country_code'  => ['string'],
            'work_id'       => ['string','nullable'],
            'company'    => ['string','nullable'],
            'phone'         => ['required', 'string', 'unique:users,phone,' . auth()->id()],
            'default_lang'  => ['sometimes', 'nullable', 'in:' . implode(',', LanguageEnum::getValues())]
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'name.string'       => 'name_format_not_valid',
                'name.min'          => 'name_min_3',
                'name.max'          => 'name_max_50',
                'country_code.required' => 'country_code_required',
                'country_code.string'   => 'country_code_format_not_valid',
                'phone.string'      => 'phone_format_not_valid',
                'phone.unique'      => 'phone_used_before',
                'default_lang.in'   => 'selected_lang_not_found'
            ];
        }

        return [];
    }
}
