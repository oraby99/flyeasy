<?php

namespace App\Http\Requests;

use App\Enums\ChannelGroup;
use App\Enums\ChannelLevel;
use App\Rules\CanAddChannel;
use App\Rules\CanAddMembers;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckModeratorsAndGuestsNotSame;
use App\Rules\CheckAuthenticatedUserNotInGuests;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Rules\CheckAuthenticatedUserNotInModerators;

class CreateChannelRequest extends FormRequest
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
            'name'          => ['required', 'string', 'min:3', 'max:100',
                               ],
            'logo'          => ['sometimes', 'nullable', 'file', 'mimes:jpeg,jpj,png', 'max:3000'],
            'moderators'    => [
                                    'sometimes',
                                    'nullable',
                                    'array',
                                    'min:1',
                                    new CheckModeratorsAndGuestsNotSame($this->guests, ChannelGroup::MODERATOR),
                                    new CheckAuthenticatedUserNotInModerators,
                                    new CanAddMembers($this->guests)
                               ],
            'moderators.*'  => ['required', 'exists:users,id'],
            'guests'        => [
                                    'sometimes',
                                    'nullable',
                                    'array',
                                    'min:1',
                                    new CheckModeratorsAndGuestsNotSame($this->moderators, ChannelGroup::GUEST),
                                    new CheckAuthenticatedUserNotInGuests,
                                    new CanAddMembers($this->moderators)
                                ],
            'guests.*'      => ['required', 'exists:users,id'],
            'parent_id'     => ['sometimes', 'nullable', 'exists:channels,id'],
            'level'         => ['required', 'in:' . implode(',', ChannelLevel::getValues()), new CanAddChannel]
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'name.required'             => 'name_required',
                'name.string'               => 'name_not_correct',
                'name.min'                  => 'name_min_3',
                'name.max'                  => 'name_max_100',
                'name.unique'               => 'name_found',
                'parent_id.exists'          => 'parent_not_found',
                'logo.file'                 => 'logo_must_be_file',
                'logo.mimes'                => 'logo_not_supported',
                'logo.max'                  => 'logo_max_3_mb',
                'moderators.array'          => 'moderators_format_not_valid',
                'moderators.min'            => 'moderators_min_1',
                'moderators.*.required'     => 'moderator_required',
                'moderators.*.exists'       => 'moderator_not_found',
                'guests.array'              => 'guests_format_not_valid',
                'guests.min'                => 'guests_min_1',
                'guests.*.required'         => 'guest_required',
                'guests.*.exists'           => 'guest_not_found',
                'level.required'            => 'level_is_required',
                'level.in'                  => 'level_not_found'
            ];
        }

        return [];
    }
}
