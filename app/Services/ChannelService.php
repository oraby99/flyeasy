<?php

namespace App\Services;

use App\Jobs\handleJoiningMembersInChannelsJob;
use App\Jobs\DeleteChannelMembersJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadFilesTrait;
use App\Jobs\DeleteChannelJob;
use App\Models\ChannelMember;
use App\Models\Subscription;
use App\Enums\ChannelLevel;
use Illuminate\Support\Arr;
use App\Models\Channel;
use App\Enums\YesOrNo;
use App\Models\User;
use Exception;
use App\Enums\ChannelGroup;

class ChannelService extends Service
{
    use UploadFilesTrait;

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $channel = Channel::create($this->sanitizeCreatingChannelData($data));
            /** After creating a channel handle creating its members **/
            (new ChannelMemberService)->handleAdding($data, $channel);
            DB::commit();
            Log::info('New Channel created', ['channel' => $channel]);
            //$this->fireChannelMembersJobs($channel);
            return User::where('id', auth()->id())->with('subscription')->first();
        } catch (Exception $e) {
            Log::error('Error while creating a new channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }
    public function update($data, $channel)
    {
        DB::beginTransaction();
        try {
            $channel->update($this->sanitizeUpdatingChannelData($data));
            (new ChannelMemberService)->handleAdding($data, $channel, true);
            DB::commit();
           // $this->fireChannelMembersJobs($channel);
            return User::where('id', auth()->id())->with('subscription')->first();
        } catch (Exception $e) {
            Log::error('Error while updating a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    private function sanitizeCreatingChannelData($data): array
    {
        if(Arr::exists($data, 'logo')) {
            $logoPath = $this->uploadFile(Arr::get($data, 'logo'), 'channels/logos')['full_file_path'];
            Arr::set($data, 'logo', $logoPath);
        }
        return array_merge(
            Arr::except($data, ['moderators', 'guests']),
            [
                'user_id' => auth()->id()
            ]
        );
    }

    private function sanitizeUpdatingChannelData($data): array
    {
        if(Arr::exists($data, 'logo')) {
            $this->deleteFile(Arr::get($data, 'logo'));
            $logoPath = $this->uploadFile(Arr::get($data, 'logo'), 'channels/logos')['full_file_path'];
            Arr::set($data, 'logo', $logoPath);
        }

        return Arr::except($data, ['moderators', 'guests']);
    }

    public function getChannelTeam($channelId)
    {
        $channel = Channel::find($channelId);
        if($channel->level == ChannelLevel::TEAM) {
            return $channel->loadMissing(['membersNotAdmins', 'communities', 'communities.membersNotAdmins', 'subCommunities', 'subCommunities.membersNotAdmins']);
        } elseif ($channel->level == ChannelLevel::COMMUNITY) {
            return Channel::where('id', $channel->parent_id)->with(['communities', 'subCommunities'])->first();
        } else {
            $teamId = Channel::where('id', $channelId)->value('parent_id');
            return Channel::where('id', $teamId)->with(['communities', 'subCommunities'])->first();
        }
    }

    public function getChannelTeamIdOnly($channelId)
    {
        $channel = Channel::find($channelId);

        if($channel->level == ChannelLevel::TEAM) {
            return $channelId;
        } elseif ($channel->level == ChannelLevel::COMMUNITY) {
            return Channel::where('id', $channel->parent_id)->value('id');
        } else {
            $teamId = Channel::where('id', $channelId)->value('parent_id');
            return Channel::where('id', $teamId)->value('id');
        }
    }

    public function fireChannelMembersJobs($channel): void
    {
        $team = $this->getChannelTeam($channel->id);

        if($team) {
            if($team->membersNotAdmins->count() > 0) {
                foreach ($team->membersNotAdmins as $member) {
                    handleJoiningMembersInChannelsJob::dispatch($member, $team);
                }
            }

            if($team->communities->count() > 0) {
                foreach ($team->communities as $community) {
                    if($community->membersNotAdmins->count() > 0) {
                        foreach ($community->membersNotAdmins as $member) {
                            handleJoiningMembersInChannelsJob::dispatch($member, $community);
                        }
                    }
                }
            }

            if($team->subCommunities->count() > 0) {
                foreach ($team->subCommunities as $subCommunity) {
                    if($subCommunity->membersNotAdmins->count() > 0) {
                        foreach ($subCommunity->membersNotAdmins as $member) {
                            handleJoiningMembersInChannelsJob::dispatch($member, $subCommunity);
                        }
                    }
                }
            }
        }
    }

    public function deleteChannelAndRelated($channel): void
    {
        $channel->loadMissing('members');
        $channel->members->chunk(100)->each(function ($members) {
            DeleteChannelMembersJob::dispatch($members);
        });
        DeleteChannelJob::dispatch($channel);
    }

    public function delete($channel)
    {
        DB::beginTransaction();
        try {
            $channel->update(['is_deleted' => YesOrNo::YES]);
            DB::commit();
            return User::where('id', auth()->id())->with('subscription')->first();
        } catch (Exception $e) {
            Log::error('Error while deleting a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    public function archive($data): bool
    {
        DB::beginTransaction();
        try {
            $channelId = Arr::get($data, 'channel_id');
            Channel::where([
                    'user_id'   => auth()->id(),
                    'id'        => $channelId
                ])
                ->orWhere('parent_id', $channelId)
                ->update(['is_archived' => YesOrNo::YES]);

            $parentChannelsIds = Channel::where('parent_id', $channelId)->pluck('id');

            Channel::whereIn('parent_id', $parentChannelsIds)->update(['is_archived' => YesOrNo::YES]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while archiving a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    public function duplicate($data)
    {
        DB::beginTransaction();
        try {
            $channel = Channel::where([
                            'user_id'       => auth()->id(),
                            'id'            => Arr::get($data, 'channel_id'),
                            'level'         => ChannelLevel::TEAM,
                            'is_archived'   => YesOrNo::NO
                        ])
                        ->with('members', 'communities', 'communities.subCommunities')
                        ->first();
            $subscription           = Subscription::where('user_id', auth()->id())->first();
            $communitiesCount       = isset($channel->communities) ? $channel->communities->count() : 0;
            $subCommunitiesCount    = isset($channel->subCommunities) ? $channel->subCommunities->count() : 0;
            $membersCount           = isset($channel->members) ? $channel->members->count() : 0;

            if(
                $subscription->remains_teams_count > 1 &&
                $subscription->remains_communities_count > $communitiesCount &&
                $subscription->remains_sub_communities_count > $subCommunitiesCount &&
                $subscription->remains_members_count > $membersCount
            ) {

                $newChannel = $channel->replicate()->fill(['name' => $channel->name . '_copy_' . $channel->copied_count + 1]);
                $newChannel->push();
                $channel->update(['copied_count' => $channel->copied_count + 1]);
                $subscription->update([
                    'added_teams_count'     => $subscription->added_teams_count + 1,
                    'remains_teams_count'   => $subscription->remains_teams_count - 1
                ]);

                if($channel->logo != null)
                    $this->copyChannelLogo($channel);

                if($newChannel->members->count() > 0) {
                    $newChannel->members()->createMany(
                        $channel->members->except('channel_id')->map->toArray()
                    );
                    $subscription->update([
                        'added_members_count'   => $subscription->added_members_count + $newChannel->members->count(),
                        'remains_members_count' => $subscription->remains_members_count - $newChannel->members->count()
                    ]);
                }



                if($channel->communities->count() > 0) {
                  foreach ($channel->communities as $community) {

                         $community->update(['copied_count' => $community->copied_count + 1]);
                         if($community->logo != null) {
                            $this->copyChannelLogo($community);
                         }

                         $newCommunity = Channel::create([
                                                'name'          => $community->name . '_copy_' . $community->copied_count + 1,
                                                'parent_id'     => $newChannel->id,
                                                'level'         => $community->level,
                                                'user_id'       => $community->user_id,
                                                'logo'          => $community->logo,
                      							'is_deleted'    => $community->is_deleted,
                                                'is_archived'   => $community->is_archived,
                                                'copied_count'  => $community->copied_count + 1
                                            ]);

                    if($community->subCommunities->count() > 0) {
                    $newSubCommunitiesData = $community->subCommunities->map(function ($subCommunity) use ($newCommunity) {
                                                $subCommunity->update(['copied_count' => $subCommunity->copied_count + 1]);
                                                if($subCommunity->logo != null)
                                                    $this->copyChannelLogo($subCommunity);

                                                return [
                                                    'name'          => $subCommunity->name . '_copy_' . $subCommunity->copied_count + 1,
                                                    'parent_id'     => $newCommunity->id,
                                                    'level'         => $subCommunity->level,
                                                    'user_id'       => $subCommunity->user_id,
                                                    'logo'          => $subCommunity->logo,
                                                    'is_deleted'    => $subCommunity->is_deleted,
                                                    'is_archived'   => $subCommunity->is_archived,
                                                    'copied_count'  => $subCommunity->copied_count + 1
                                                ];
                                            });

                           Channel::insert($newSubCommunitiesData->toArray());
                    $subscription->update([
                        'added_sub_communities_count'   => $subscription->added_sub_communities_count + $newChannel->subCommunities->count(),
                        'remains_sub_communities_count' => $subscription->remains_sub_communities_count - $newChannel->subCommunities->count()
                    ]);
                }

                  }

                    $subscription->update([
                        'added_communities_count'   => $subscription->added_communities_count + $newChannel->communities->count(),
                        'remains_communities_count' => $subscription->remains_communities_count - $newChannel->communities->count()
                    ]);
                }


                DB::commit();
                return User::where('id', auth()->id())->with('subscription')->first();
            }
            return 'cant_make_duplicate';
        } catch (Exception $e) {
            Log::error('Error while duplicating a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    private function copyChannelLogo($channel): void
    {
        $pathInfo = pathinfo($channel->logo);
        $newFilename = 'channels/logos/' . $pathInfo['filename'] . '_copy_' . $channel->copied_count + 1 . '.' . $pathInfo['extension'];
        copy('storage/app/' . $channel->logo, 'storage/app/' . $newFilename);
    }

    public function getModeratorsGuests($channel)
    {
        return User::join('channels_members', function ($join) {
                    return $join->on('users.id', '=', 'channels_members.member_id')
                        ->where('channels_members.is_joined', YesOrNo::YES);
                })
                ->join('channels', function ($join) {
                    return $join->on('channels_members.channel_id', '=', 'channels.id')
                        ->where([
                            'channels.is_archived'  => YesOrNo::NO,
                            'channels.is_deleted'   => YesOrNo::NO
                        ]);
                })
                ->where('channels.id', $channel->id)
                ->select('users.*')
                ->paginate(self::PERPAGE);
    }

    public function getAuthenticateJoined($data)
    {
        try {
            $ignoredChannelId = Arr::get($data, 'ignored_channel_id');
            $search = Arr::get($data, 'search');
    
            // Return empty collection if no search key is provided
            if (empty($search)) {
                return collect([]); // You can also return a paginated empty array if needed
            }
    
            return ChannelMember::where('member_id', auth()->id())
                ->where('is_joined', YesOrNo::YES)
                // ->where('member_group', '!=', ChannelGroup::ADMIN)
                ->whereHas('channel', function ($q) use ($data, $search) {
                    return $q->where('channels.name', 'like', '%' . $search . '%');
                })
                // ->when(Arr::exists($data, 'ignored_channel_id'), function ($q) use ($ignoredChannelId) {
                //     return $q->where('channel_id', '!=', $ignoredChannelId);
                // })
                ->paginate(self::PERPAGE);
        } catch (Exception $e) {
            Log::error('Error while getting channels for authenticated user that his joined in it', [
                'error' => $e->getMessage(), 
                'trace' => $e->__toString()
            ]);
            return false;
        }
    }
    
}
