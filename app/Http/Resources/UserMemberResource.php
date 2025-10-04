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
        $profileImage = $this->user->profile_image ?? $this->profile_image;
        return [
            'id'            => $this->user->id ?? $this->id,
            'name'          => $this->user->name ?? $this->name,
            'email'         => $this->user->email ?? $this->email,
            'phone'         => $this->user->phone ?? $this->phone,
            'profile_image' => $profileImage ? asset('storage/'.$profileImage) : null,
            'device_token'  => $this->user->device_token ?? $this->device_token,
        ];
    }
}
