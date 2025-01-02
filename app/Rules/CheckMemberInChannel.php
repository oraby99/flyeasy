<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\ChannelMember;
use Closure;

class CheckMemberInChannel implements ValidationRule
{
    private $channelId;

    public function __construct($channelId)
    {
        $this->channelId = $channelId;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $members = ChannelMember::where('channel_id', $this->channelId)
                        ->whereIn('member_id', $value)
                        ->get();

        if($members->count() == 0)
            $fail('members_not_in_channel');
    }
}
