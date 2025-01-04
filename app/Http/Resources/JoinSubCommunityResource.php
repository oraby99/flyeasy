<?php

namespace App\Http\Resources;

use App\Models\ChannelMember;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;
use App\Enums\YesOrNo;

class JoinSubCommunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $channelsJoinedIn   = ChannelMember::where('member_id', auth()->id())->pluck('member_group', 'channel_id');
        $isJoined = array_key_exists($this->id, $channelsJoinedIn->toArray());
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'logo'      => $this->logo == null ? asset('admin/images/OIG__36_-removebg.png') : url('storage/app/' . $this->logo),
            'group'             => $isJoined ? strtolower(ChannelGroup::getName($channelsJoinedIn[$this->id])) : 'guest',
            'is_joined'         => $isJoined ? 'yes' : 'no'
        ];
    }
}
