<?php

namespace App\Http\Resources;
use App\Enums\ChannelGroup;
use Illuminate\Http\Request;
use App\Models\ChannelMember;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

public function toArray(Request $request): array
{
    $authenticatedUser  = auth()->user()->loadMissing('subscription');
    $subscription       = $authenticatedUser->subscription;
    $member_group       = ChannelMember::where('member_id', auth()->user()->id)->where('channel_id',$this->id)->first();
    $authenticatedUser2 = $member_group ? $member_group->member_group : 1;
    $moderators  = $this->moderators;
    $guests      = $this->guests;
    $creator     = $this->creator;

    return [
        'id'                            => $this->id,
        'member_group'                  => $authenticatedUser2,
        'name'                          => $this->name,
        'logo'                          => $this->logo == null ? asset('admin/images/OIG__36_-removebg.png') : url('storage/app/' . $this->logo),
        'creator'                       => UserResource::collection($creator),
        'moderators'                    => UserResource::collection($moderators),
        'guests'                        => UserResource::collection($guests),
        'added_teams_count'             => $subscription->added_teams_count,
        'remains_teams_count'           => $subscription->remains_teams_count,
        'added_communities_count'       => $subscription->added_communities_count,
        'remains_communities_count'     => $subscription->remains_communities_count,
        'added_sub_communities_count'   => $subscription->added_sub_communities_count,
        'remains_sub_communities_count' => $subscription->remains_sub_communities_count,
        'added_members_count'           => $subscription->added_members_count,
        'remains_members_count'         => $subscription->remains_members_count
    ];
}

}
