<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->user->id,
            'name'          => $this->user->name,
            'email'         => $this->user->email,
            'phone'         => $this->user->phone,
            'profile_image' => $this->user->profile_image == null ? asset('admin/images/profile.png') : asset('storage/' . $this->user->profile_image),
            'device_token'  => $this->user->device_token
        ];
    }
}
