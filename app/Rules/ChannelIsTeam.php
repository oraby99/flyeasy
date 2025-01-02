<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Enums\ChannelLevel;
use App\Models\Channel;
use Closure;

class ChannelIsTeam implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $channel = Channel::find($value);
        if($channel->level != ChannelLevel::TEAM)
            $fail('channel_not_team');
    }
}
