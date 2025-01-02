<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ForwardToUserRequest extends FormRequest
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
            'who_receive_message'  => ['required', 'array', 'min:1'],
            'who_receive_message.*'  => ['exists:users,id']
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'who_receive_message.required'  => 'who_receive_message_required',
                'who_receive_message.array'     => 'who_receive_message_not_array',
                'who_receive_message.min'       => 'who_receive_message_is_empty',
                'who_receive_message.*.exists'  => 'who_receive_message_not_found'
            ];
        }

        return [];
    }
}
