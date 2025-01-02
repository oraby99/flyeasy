<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Channel;
use App\Enums\YesOrNo;
use Closure;

class ChannelIsArchived implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $channel = Channel::find($value);
        if($channel->is_archived == YesOrNo::YES)
            $fail('channel_is_archived');
    }
}
