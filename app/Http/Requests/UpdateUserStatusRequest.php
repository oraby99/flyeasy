<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ActivationStatus;

class UpdateUserStatusRequest extends FormRequest
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
            'status'    => ['required', 'in:' . implode(',', ActivationStatus::getValues())],
            'discount'  => ['required', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'status.required'   => __('custom-validation.status_required'),
            'status.in'         => __('custom-validation.status_in'),
            'discount.required' => __('custom-validation.discount-required'),
            'discount.integer'  => __('custom-validation.discount-format-not-valid')
        ];
    }
}
