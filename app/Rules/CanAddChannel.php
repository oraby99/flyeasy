<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Subscription;
use App\Enums\ChannelLevel;
use Closure;

class CanAddChannel implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $subscription = Subscription::where('user_id', auth()->id())->first();

        if($value == ChannelLevel::TEAM)
            if($subscription->remains_teams_count == 0)
                $fail('can_not_add_team');

        if($value == ChannelLevel::COMMUNITY)
            if($subscription->remains_communities_count == 0)
                $fail('can_not_add_community');

        if($value == ChannelLevel::SUBCOMMUNITY)
            if($subscription->remains_sub_communities_count == 0)
                $fail('can_not_add_sub_community');

    }
}
