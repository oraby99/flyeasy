<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use Closure;

class CheckUserOldPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Hash::check($value, auth()->user()->password))
            $fail('old_password_not_correct');
    }
}
