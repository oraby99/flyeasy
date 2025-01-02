<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\ChannelService;
use Illuminate\Bus\Queueable;
use App\Enums\ChannelLevel;

class HandleDeletingChannelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $channel;

    /**
     * Create a new job instance.
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->channel->level == ChannelLevel::TEAM) {
            $this->channel->loadMissing(['communities', 'communities.subCommunities']);

            foreach($this->channel->communities as $community) {
                /** Delete sub communities **/
                foreach($community->subCommunities as $subCommunity)
                    (new ChannelService)->deleteChannelAndRelated($subCommunity);

                /** Delete communities **/
                (new ChannelService)->deleteChannelAndRelated($community);
            }

            /** Delete team **/
            (new ChannelService)->deleteChannelAndRelated($this->channel);
        } elseif($this->channel->level == ChannelLevel::COMMUNITY) {
            $this->channel->loadMissing(['subCommunities']);

            /** Delete sub communities **/
            foreach($this->channel->subCommunities as $subCommunity)
                (new ChannelService)->deleteChannelAndRelated($subCommunity);

            /** Delete communities **/
            (new ChannelService)->deleteChannelAndRelated($this->channel);

        } else {
            /** Delete subCommunity **/
            (new ChannelService)->deleteChannelAndRelated($this->channel);
        }
    }
}
