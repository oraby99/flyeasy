<?php

namespace App\Observers;

use App\Jobs\SendingRegistrationMailJob;
use App\Jobs\AssignFreeCountsToUserJob;
use App\Services\SubscriptionService;
use App\Enums\UserGroup;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if($user->group != UserGroup::ADMIN) {
//            SendingRegistrationMailJob::dispatch($user);
//            AssignFreeCountsToUserJob::dispatch($user);
            (new SubscriptionService)->storeFreeCounts($user);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
