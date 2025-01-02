<?php

namespace App\Http\Resources;

use App\Models\ChannelMember;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;
use App\Enums\YesOrNo;

class JoinCommunityResource extends JsonResource
{
public function toArray(Request $request)
{
    $channelsJoinedIn = ChannelMember::where('member_id', auth()->id())->pluck('member_group', 'channel_id');
    $isJoined = array_key_exists($this->id, $channelsJoinedIn->toArray());
    if (!$isJoined && $this->subCommunities->isEmpty()) {
        return ['message' => 'no community'];
    }
    return [
        'id' => $this->id,
        'name' => $this->name,
        'logo' => $this->logo == null ? asset('admin/images/OIG__36_-removebg.png') : asset('storage/' . $this->logo),
        'group' => $isJoined ? strtolower(ChannelGroup::getName($channelsJoinedIn[$this->id])) : 'guest',
        'is_joined' => $isJoined ? 'yes' : 'no',
        'sub_communities' => !is_null($this->subCommunities) ? JoinSubCommunityResource::collection($this->subCommunities) : null, // Return null instead of an empty array
    ];
}



}
