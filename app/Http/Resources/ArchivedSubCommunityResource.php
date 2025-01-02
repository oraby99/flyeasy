<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;
use App\Enums\YesOrNo;

class ArchivedSubCommunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->channel->id,
            'name'      => $this->channel->name,
            'logo'      => $this->channel->logo == null ? asset('admin/images/OIG__36_-removebg.png') : asset('storage/' . $this->channel->logo),
            'group'     => strtolower(ChannelGroup::getName($this->member_group)),
            'is_joined' => (bool) ($this->is_joined == YesOrNo::YES)
        ];
    }
}
