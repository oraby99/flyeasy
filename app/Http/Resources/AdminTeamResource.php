<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class AdminTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'notify_counter'    => $this->notify_counter,
            'logo'              => $this->logo == null ? asset('admin/images/OIG__36_-removebg.png') : url('storage/app/' . $this->logo),
            'members_count'     => $this->members->count(),
            'communities_count' => $this->communities->count(),
            'communities'       => !is_null($this->communities) ? AdminCommunityResource::collection($this->communities) : []
        ];
    }
}
