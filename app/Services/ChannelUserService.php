<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\ChannelMember;
use App\Enums\ChannelLevel;
use App\Enums\ChannelGroup;
use Illuminate\Support\Arr;
use App\Models\ChatUser;
use App\Models\Channel;
use App\Enums\YesOrNo;
use Exception;

class ChannelUserService extends Service
{
    public function getAdminChannels()
    {
        try {
            return Channel::where([
                        'user_id'       => auth()->id(),
                        'level'         => ChannelLevel::TEAM,
                        'is_archived'   => YesOrNo::NO
                    ])
                    ->with(['members', 'communities', 'communities.subCommunities'])
                    ->orderBy('updated_at', 'desc')
                    ->paginate(self::PERPAGE);
        } catch (Exception $e) {
            Log::error('Error while getting channels for authenticated user that his in it as admin', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function getJoinedChannels()
    {
        try {
            $teamsJoinedIn = ChannelMember::where('member_group', '!=', ChannelGroup::ADMIN)
                ->where('member_id', auth()->id())
                ->pluck('team_id');
    
            $teamsWithJoinedSubcommunities = Channel::whereHas('communities.subCommunities.members', function ($query) {
                $query->where('member_id', auth()->id())->where('member_group', '!=', ChannelGroup::ADMIN);
            })->pluck('id');
    
            $teamsToInclude = $teamsJoinedIn->merge($teamsWithJoinedSubcommunities);
    
            // Retrieve channels and apply filters
            $channels = Channel::where([
                'level'       => ChannelLevel::TEAM,
                'is_archived' => YesOrNo::NO,
            ])
            ->whereIn('id', $teamsToInclude)
            ->with(['members', 'communities', 'communities.subCommunities'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->filter(function ($channel) {
                $isJoined = ChannelMember::where('member_id', auth()->id())
                    ->where('channel_id', $channel->id)
                    ->exists();
                
                return $isJoined || $channel->communities->count() > 0;
            });
    
            return $channels;
    
        } catch (Exception $e) {
            Log::error('Error while getting channels for authenticated user that is joined in it', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
    
    

    public function getArchivedChannels()
    {
        try {
            return ChannelMember::where([
                        'member_id'     => auth()->id(),
                        'channel_level' => ChannelLevel::TEAM
                    ])
                    ->whereHas('channel', function ($q) {
                        return $q->where('is_archived', YesOrNo::YES)
                            ->with(['channel.members', 'joinedCommunities', 'joinedCommunities.channel', 'joinedCommunities.joinedSubCommunities', 'joinedCommunities.joinedSubCommunities.channel']);
                    })
                    ->paginate(self::PERPAGE);
        } catch (Exception $e) {
            Log::error('Error while getting channels for authenticated user that it archived', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function forward($data): bool
    {
        DB::beginTransaction();
        try {
            foreach(Arr::get($data, 'who_receive_message') as $userId) {
                $checkFounding = ChatUser::where([
                                    'who_start_chat'        => auth()->id(),
                                    'who_receive_message'   => $userId
                                ])
                                ->orWhere([
                                    'who_start_chat'        => $userId,
                                    'who_receive_message'   => auth()->id()
                                ])
                                ->first();

                if(!$checkFounding) {
                    ChatUser::create([
                        'who_start_chat'        => auth()->id(),
                        'who_receive_message'   => $userId
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while forwarding a message to another user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }
    public function recentChats()
    {
        try {
            $authUserId = auth()->id();
            return ChatUser::select(
                    'chat_users.id as chat_user_id',
                    'users.id as user_id',
                    'users.name',
                    'users.phone',
                    'users.profile_image',
                    'chat_users.notify_counter',
                    'chat_users.counter',
                    'chat_users.created_at',
                    'chat_users.updated_at',
                    )
                ->join('users', function ($join) use ($authUserId) {
                    $join->on('users.id', '=', DB::raw("
                        CASE
                            WHEN chat_users.who_start_chat != {$authUserId} THEN chat_users.who_start_chat
                            WHEN chat_users.who_receive_message != {$authUserId} THEN chat_users.who_receive_message
                        END
                    "));
                })
                ->where(function ($query) use ($authUserId) {
                    $query->where('chat_users.who_start_chat', $authUserId)
                          ->orWhere('chat_users.who_receive_message', $authUserId);
                })
                 ->orderBy('chat_users.updated_at','desc')
                ->groupBy('users.id')
                ->paginate(self::PERPAGE);
        } catch (Exception $e) {
            Log::error('Error while getting recent chats', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function deleteMembers($data): bool
    {
        DB::beginTransaction();
        try {
            ChannelMember::where('channel_id', Arr::get($data, 'channel_id'))
                ->whereIn('member_id', Arr::get($data, 'members'))
                ->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while deleting members for a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }
}
