<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class CheckAuthenticatedUserNotInGuests implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(isset($value) && count($value) > 0)
            if(in_array(auth()->id(), $value))
                $fail('authenticated_user_in_guests');
    }
}
