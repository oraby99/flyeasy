<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class AdminCommunityResource extends JsonResource
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
            'logo'              => $this->logo == null ? asset('admin/images/OIG__36_-removebg.png') : url('storage/app/' . $this->logo),
            'sub_communities'   => !is_null($this->subCommunities) ? AdminSubCommunityResource::collection($this->subCommunities) : []
        ];
    }
}
