<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'user_id'       => $this->user_id,
            'from'          => $this->from,
            'channel_id'    => $this->channel_id,
            'type'          => $this->type,
            'username'      => $this->username,
            'chat_user_id'  => $this->chat_user_id,
            'Channelname'   => optional($this->channel)->name,
            'profile_image' => $this->profile_image == null ? asset('admin/images/profile.png') : url('storage/app/' . $this->profile_image),
            'channel_image' => optional($this->channel)->channel_image == null ? asset('admin/images/OIG__36_-removebg.png') : url('storage/app/' . optional($this->channel)->channel_image),
            'message'       => $this->message,
            'created_at'    => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }


}
