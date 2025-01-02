<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use App\Models\ChannelMember;
use Exception;

class handleJoiningMembersInChannelsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $channelMember;
    private $channel;

    /**
     * Create a new job instance.
     */
    public function __construct($channelMember, $channel)
    {
        $this->channelMember    = $channelMember;
        $this->channel          = $channel;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            ChannelMember::updateOrCreate(
                [
                    'channel_id'    => $this->channel->id,
                    'member_id'     => $this->channelMember->member_id,
                    'member_group'  => $this->channelMember->member_group
                ],
                [
                    'team_id' => $this->channel->parent_id ?? $this->channel->id,
                    'channel_level' => $this->channel->level
                ]
            );

            DB::commit();
        } catch (Exception $e) {
            Log::error('Error while handling joining members in a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
        }
    }
}
