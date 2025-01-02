<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;
use App\Enums\YesOrNo;

class ArchivedCommunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
{
    $channel = $this->channel;

    if ($channel) {
        return [
            'id'                => $channel->id,
            'name'              => $channel->name,
            'logo'              => $channel->logo == null ? asset('admin/images/OIG__36_-removebg.png') : asset('storage/' . $channel->logo),
            'group'             => strtolower(ChannelGroup::getName($this->member_group)),
            'is_joined'         => (bool) ($this->is_joined == YesOrNo::YES),
            'sub_communities'   => !is_null($this->joinedSubCommunities) ? ArchivedSubCommunityResource::collection($this->joinedSubCommunities) : []
        ];
    } else {
        // Handle the case when $this->channel is null
        return ["message" => "no Archived Community"];
    }
}

}
