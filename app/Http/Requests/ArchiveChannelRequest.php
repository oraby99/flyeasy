<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserIsChannelAdmin;
use App\Rules\ChannelIsTeam;

class ArchiveChannelRequest extends FormRequest
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
            'channel_id' => ['required', 'exists:channels,id', new UserIsChannelAdmin(), new ChannelIsTeam()]
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'channel_id.required'   => 'channel_id_required',
                'channel_id.exists'     => 'channel_id_not_found'
            ];
        }

        return [];
    }
}
