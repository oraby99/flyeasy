<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Subscription;
use Closure;

class CanAddMembers implements ValidationRule
{
    private $anotherUsers;

    public function __construct($anotherUsers)
    {
        $this->anotherUsers = $anotherUsers;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(isset($value, $this->anotherUsers)) {
            $subscription = Subscription::where('user_id', auth()->id())->first();
            $membersCount = 0;

            if(count($value) > 0)
                $membersCount += count($value);

            if(count($this->anotherUsers) > 0)
                $membersCount += count($this->anotherUsers);

            if($subscription->remains_members_count < $membersCount)
                $fail('moderators_and_anotherUsers_count_bigger_than_available');
        }

    }
}
