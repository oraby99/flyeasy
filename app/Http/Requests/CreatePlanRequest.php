<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\PlanTypeEnum;

class CreatePlanRequest extends FormRequest
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
            'name'          => ['required', 'string', 'min:3', 'max:255', 'unique:plans,name'],
            'type'          => ['required', 'in:' . implode(',', PlanTypeEnum::getValues())],
            'count'         => ['sometimes', 'nullable', 'integer'],
            'price'         => ['required', 'integer', 'min:1'],
            'sections'      => [Rule::requiredIf($this->type == PlanTypeEnum::LIBRARY), 'array', 'min:1'],
            'sections.*'    => ['exists:library_sections,id'],
            'num_of_months' => ['sometimes', 'nullable', 'integer', 'min:1', Rule::requiredIf($this->type == PlanTypeEnum::LIBRARY)]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'             => __('custom-validation.name-required'),
            'name.string'               => __('custom-validation.name-string'),
            'name.min'                  => __('custom-validation.name-min-3'),
            'name.max'                  => __('custom-validation.name-max-255'),
            'name.unique'               => __('custom-validation.name-exists'),
            'type.required'             => __('custom-validation.type-required'),
            'type.in'                   => __('custom-validation.type-not-found'),
            'count.integer'             => __('custom-validation.count-format-not-valid'),
            'price.required'            => __('custom-validation.price-required'),
            'price.integer'             => __('custom-validation.price-format-not-valid'),
            'price.min'                 => __('custom-validation.price-min-1'),
            'sections.required_if'      => __('custom-validation.sections-required'),
            'sections.array'            => __('custom-validation.sections-not-valid-format'),
            'sections.min'              => __('custom-validation.sections-min-1'),
            'num_of_months.required_if' => __('custom-validation.num-of-months-require'),
            'num_of_months.int'         => __('custom-validation.num-of-months-not-valid-format'),
            'num_of_months.min'         => __('custom-validation.num-of-months-min-1')
        ];
    }
}
