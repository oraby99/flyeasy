<?php

namespace App\Http\Resources;

use App\Models\ChannelMember;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;
use Carbon\Carbon;

class JoinTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $channelMembers = ChannelMember::where('member_id', auth()->id())
            ->get(['channel_id', 'member_group', 'created_at'])
            ->keyBy('channel_id');
    
        $isJoined = $channelMembers->has($this->id);
    
        if ($isJoined || $this->communities->count() > 0) {
            $channelMember = $channelMembers->get($this->id);
    
            return [
                'id'                => $this->id,
                'name'              => $this->name,
                'notify_counter'    => $this->notify_counter,
                'logo'              => $this->logo == null ? asset('admin/images/OIG__36_-removebg.png') : asset('storage/' . $this->logo),
                'members_count'     => $this->members ? $this->members->count() : 0,
                'group'             => $isJoined ? strtolower(ChannelGroup::getName($channelMember->member_group)) : 'guest',
                'is_joined'         => $isJoined ? 'yes' : 'no',
                'created_at'        => $isJoined ? Carbon::parse($channelMember->created_at)->format('d M Y, h:i A') : null,
                'communities_count' => $this->communities->count(),
                'communities'       => !is_null($this->communities) ? JoinCommunityResource::collection($this->communities) : []
            ];
        }
    
        return [];
    }
    
}
