<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class RecentChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'chat_user_id'   => $this->chat_user_id,
            'user_id'        => $this->user_id,
            'name'           => $this->name,
            'notify_counter' => $this->notify_counter,
            'phone'         => $this->phone, 
            'counter'        => $this->counter,
            'profile_image'  => $this->profile_image == null ? asset('admin/images/profile.png') : url('storage/app/' . $this->profile_image)
        ];
    }
}
