<?php

namespace App\Observers;

use App\Jobs\HandleDeletingChannelJob;
use App\Models\Channel;
use App\Enums\YesOrNo;

class ChannelObserver
{
    /**
     * Handle the Channel "created" event.
     */
    public function created(Channel $channel): void
    {
        //
    }

    /**
     * Handle the Channel "updated" event.
     */
    public function updated(Channel $channel): void
    {
        if($channel->is_deleted == YesOrNo::YES)
            HandleDeletingChannelJob::dispatch($channel);

    }

    /**
     * Handle the Channel "deleted" event.
     */
    public function deleted(Channel $channel): void
    {
        //
    }

    /**
     * Handle the Channel "restored" event.
     */
    public function restored(Channel $channel): void
    {
        //
    }

    /**
     * Handle the Channel "force deleted" event.
     */
    public function forceDeleted(Channel $channel): void
    {
        //
    }
}
