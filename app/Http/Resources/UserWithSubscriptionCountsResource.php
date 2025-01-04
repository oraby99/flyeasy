<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserWithSubscriptionCountsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'token'         => $this->when(isset($this->token), $this->token),
            'profile_image' => $this->profile_image == null ? asset('admin/images/profile.png') : url('storage/app/' . $this->profile_image),
            'device_token'  => $this->device_token
        ];
    }
}
