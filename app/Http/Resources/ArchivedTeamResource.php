<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;

class ArchivedTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->channel->id,
            'name'              => $this->channel->name,
            'logo'              => $this->channel->logo == null ? asset('admin/images/OIG__36_-removebg.png') : asset('storage/' . $this->channel->logo),
            'group'             => strtolower(ChannelGroup::getName($this->member_group)),
            'members_count'     => $this->members->count(),
            'communities'       => !is_null($this->joinedCommunities) ? ArchivedCommunityResource::collection($this->joinedCommunities) : []
        ];
    }
}
