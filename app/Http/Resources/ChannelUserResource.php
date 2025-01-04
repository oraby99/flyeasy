<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\ChannelGroup;
use App\Enums\ChannelLevel;

class ChannelUserResource extends JsonResource
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
            'logo'              => $this->channel->logo == null ? asset('admin/images/OIG__36_-removebg.png') : url('storage/app/' . $this->channel->logo),
            'channel_level'     => strtolower(ChannelLevel::getName($this->channel_level)),
            'group'             => strtolower(ChannelGroup::getName($this->member_group))
        ];
    }
}
