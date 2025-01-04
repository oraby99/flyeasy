<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Enums\YesOrNo;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                            => $this->id,
            'name'                          => $this->name,
            'email'                         => $this->email,
            'country_code'                  => $this->country_code,
            'phone'                         => $this->phone,
            'work_id'                       => $this->work_id,
            'company'                       => $this->company,
            'token'                         => $this->when(isset($this->token), $this->token),
            'profile_image'                 => $this->profile_image == null ? asset('admin/images/profile.png') : url('storage/app/' . $this->profile_image),
            'device_token'                  => $this->device_token,
            'is_joined'                     => $this->whenPivotLoaded('channels_members', function () {
                                                   return strtolower(YesOrNo::getName($this->pivot->is_joined));
                                               }),
            'added_teams_count'             => $this->subscription->added_teams_count,
            'remains_teams_count'           => $this->subscription->remains_teams_count,
            'added_communities_count'       => $this->subscription->added_communities_count,
            'remains_communities_count'     => $this->subscription->remains_communities_count,
            'added_sub_communities_count'   => $this->subscription->added_sub_communities_count,
            'remains_sub_communities_count' => $this->subscription->remains_sub_communities_count,
            'added_members_count'           => $this->subscription->added_members_count,
            'remains_members_count'         => $this->subscription->remains_members_count
        ];
    }
}
