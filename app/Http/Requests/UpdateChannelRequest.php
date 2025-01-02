<?php

namespace App\Http\Requests;

use App\Rules\CheckAuthenticatedUserNotInModerators;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Rules\CheckAuthenticatedUserNotInGuests;
use App\Rules\CheckModeratorsAndGuestsNotSame;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ChannelMember;
use App\Rules\CanAddMembers;
use App\Enums\ChannelGroup;
use Illuminate\Support\Facades\Log;

class UpdateChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $channelId = $this->channel->id;
        $userId = auth()->id();
        $authenticatedGroup = ChannelMember::where(['channel_id' => $channelId, 'member_id' => $userId])->value('member_group');

        Log::info('Authorization check', [
            'channel_id' => $channelId,
            'user_id' => $userId,
            'authenticated_group' => $authenticatedGroup,
            'channel_user_id' => $this->channel->user_id,
        ]);

        if($this->channel->user_id == $userId || $authenticatedGroup == ChannelGroup::MODERATOR)
            return true;

        return false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => ['sometimes', 'nullable', 'string', 'min:3', 'max:100', 'unique:channels,name'],
            'logo'          => ['sometimes', 'nullable', 'file', 'mimes:jpeg,jpj,png', 'max:3000'],
            'moderators'    => [
                                    'sometimes',
                                    'nullable',
                                    'array',
                                    'min:1',
                                    new CheckModeratorsAndGuestsNotSame($this->guests, ChannelGroup::MODERATOR),
                                    //new CheckAuthenticatedUserNotInModerators,
                                    new CanAddMembers($this->guests)
                               ],
            'moderators.*'  => ['required', 'exists:users,id'],
            'guests'        => [
                                    'sometimes',
                                    'nullable',
                                    'array',
                                    'min:1',
                                    new CheckModeratorsAndGuestsNotSame($this->moderators, ChannelGroup::GUEST),
                                    //new CheckAuthenticatedUserNotInGuests,
                                    new CanAddMembers($this->moderators)
                               ],
            'guests.*'      => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        if(request()->is('api/*')) {
            return [
                'name.string'               => 'name_not_correct',
                'name.min'                  => 'name_min_3',
                'name.max'                  => 'name_max_100',
                'name.unique'               => 'name_founded_before',
                'logo.file'                 => 'logo_must_be_file',
                'logo.mimes'                => 'logo_not_supported',
                'logo.max'                  => 'logo_max_3_mb',
                'moderators.array'          => 'moderators_format_not_valid',
                'moderators.min'            => 'moderators_min_1',
                'moderators.*.exists'       => 'moderator_not_found',
                'guests.array'              => 'guests_format_not_valid',
                'guests.min'                => 'guests_min_1',
                'guests.*.exists'           => 'guest_not_found'
            ];
        }

        return [];
    }
}
