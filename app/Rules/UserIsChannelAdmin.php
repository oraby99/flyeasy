<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Channel;
use Closure;

class UserIsChannelAdmin implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $channel = Channel::where('id', $value)->first();

        if($channel)
            if($channel->user_id != auth()->id())
                $fail('authenticated_user_dosnt_admin_for_this_channel');
    }
}
