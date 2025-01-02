<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\ChannelMember;
use Illuminate\Support\Arr;
use App\Enums\ChannelGroup;
use App\Enums\ChannelLevel;
use App\Enums\YesOrNo;
use Exception;

class ChannelMemberService
{
    public function handleAdding($data, $channel, $update = false): void
    {
        /** If updating a channel is processing deleting in first, then insert **/
        if($update) {
            $oldMembersCount = ChannelMember::where('channel_id', $channel->id)->count();
            ChannelMember::where('channel_id', $channel->id)->delete();
        }

        $newMembers = $this->sanitizeInsertingChannelMembersData($data, $channel);
        ChannelMember::insert($newMembers);

        (new SubscriptionService)->updateCounts($channel->level, count($newMembers), $oldMembersCount ?? 0, $update);
    }

    private function sanitizeInsertingChannelMembersData($data, $channel): array
    {
        $result = [];

        $teamId = (new ChannelService())->getChannelTeamIdOnly($channel->id);

        /** Add admin for ($channel) **/
        $result[] = [
            'channel_id'    => $channel->id,
            'member_id'     => $channel->user_id,
            'member_group'  => ChannelGroup::ADMIN,
            'channel_level' => $channel->level,
            'is_joined'     => YesOrNo::YES,
            'team_id'       => $teamId,
            'created_at'    => now(),
            'updated_at'    => now()
        ];

        /** Add moderators for ($channel) if sent **/
        if(Arr::exists($data, 'moderators')) {
            foreach(Arr::get($data, 'moderators') as $moderatorId) {
                $result[] = [
                    'channel_id'    => $channel->id,
                    'member_id'     => $moderatorId,
                    'member_group'  => ChannelGroup::MODERATOR,
                    'channel_level' => $channel->level,
                    'is_joined'     => YesOrNo::YES,
                    'team_id'       => $teamId,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ];
            }
        }

        /** Add guests for ($channel) if sent **/
        if(Arr::exists($data, 'guests')) {
            foreach(Arr::get($data, 'guests') as $guestId) {
                $result[] = [
                    'channel_id'    => $channel->id,
                    'member_id'     => $guestId,
                    'member_group'  => ChannelGroup::GUEST,
                    'channel_level' => $channel->level,
                    'is_joined'     => YesOrNo::YES,
                    'team_id'       => $teamId,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ];
            }
        }

        return $result;
    }

    public function handleJoiningMembersInChannels($channelMember): void
    {
        DB::beginTransaction();
        try {
            $team = (new ChannelService)->getChannelTeam($channelMember->channel_id);

            /** For team **/
            $this->updateOrCreateChannelMember($team, $channelMember, ChannelLevel::TEAM);

            /** For communities **/
            if($team->communities->count() > 0) {
                foreach ($team->communities as $community) {
                    $this->updateOrCreateChannelMember($community, $channelMember, ChannelLevel::COMMUNITY);
                }
            }

            /** For sub communities **/
            if($team->subCommunities->count() > 0) {
                foreach ($team->subCommunities as $subCommunity) {
                    $this->updateOrCreateChannelMember($subCommunity, $channelMember, ChannelLevel::SUBCOMMUNITY);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            Log::error('Error while handling joining members in a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
        }
    }

    private function updateOrCreateChannelMember($channel, $channelMember, $channelLevel): void
    {
        ChannelMember::updateOrCreate(
            [
                'channel_id'    => $channel->id,
                'member_id'     => $channelMember->member_id,
                'member_group'  => $channelMember->member_group,
                'channel_level' => $channelLevel
            ],
            [
                'team_id' => $channel->parent_id ?? $channel->id
            ]
        );
    }

}
