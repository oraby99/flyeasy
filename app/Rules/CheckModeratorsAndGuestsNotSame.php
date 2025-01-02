<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Enums\ChannelGroup;
use Closure;

class CheckModeratorsAndGuestsNotSame implements ValidationRule
{
    private $anotherUsers;
    private $group;

    public function __construct($anotherUsers, $group)
    {
        $this->anotherUsers = $anotherUsers;
        $this->group        = $group;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** Check if moderators and guests are selected when create or update channels **/
        if(isset($value, $this->anotherUsers))
            /** Check if moderators and guests have values not [] when create or update channels **/
            if(count($value) > 0 && count($this->anotherUsers) > 0)
                /** Check if moderators and guests are different **/
                if(count(array_diff($value, $this->anotherUsers)) != count($value))
                    if(request()->is('api/*'))
                        $this->group == ChannelGroup::MODERATOR ? $fail('moderators_in_guests') : $fail('guests_in_moderators');
    }
}
