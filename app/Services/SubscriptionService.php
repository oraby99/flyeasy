<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use App\Enums\ChannelLevel;
use App\Enums\UserGroup;
use App\Models\Setting;
use Exception;

class SubscriptionService extends Service
{
    public function all(): LengthAwarePaginator
    {
        return Subscription::with('user')->paginate(self::PERPAGE);
    }

    public function storeFreeCounts($user): bool
    {
        if($user->group == UserGroup::ADMIN)
            return true;

        DB::beginTransaction();
        try {
            $settings = Setting::all();
            Subscription::create([
                'user_id'                       => $user->id,
                'remains_teams_count'           => $settings->where('key', 'free_teams_count')->value('value'),
                'remains_communities_count'     => $settings->where('key', 'free_communities_count')->value('value'),
                'remains_sub_communities_count' => $settings->where('key', 'free_sub_communities_count')->value('value'),
                'remains_members_count'         => $settings->where('key', 'free_members_count')->value('value')
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while creating subscription plan for authenticated user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    public function updateCounts($channelLevel, $newMembersCount, $oldMembersCount = 0, $updateChannel = false): bool
    {
        DB::beginTransaction();
        try {
            $subscription = Subscription::where('user_id', auth()->id())->first();
            $subscription->update([
                'added_teams_count'             => $subscription->added_teams_count + ($channelLevel == ChannelLevel::TEAM && !$updateChannel ? 1 : 0),
                'remains_teams_count'           => $subscription->remains_teams_count - ($channelLevel == ChannelLevel::TEAM && !$updateChannel ? 1 : 0),
                'added_communities_count'       => $subscription->added_communities_count + ($channelLevel == ChannelLevel::COMMUNITY && !$updateChannel ? 1 : 0),
                'remains_communities_count'     => $subscription->remains_communities_count - ($channelLevel == ChannelLevel::COMMUNITY && !$updateChannel ? 1 : 0),
                'added_sub_communities_count'   => $subscription->added_sub_communities_count + ($channelLevel == ChannelLevel::SUBCOMMUNITY && !$updateChannel ? 1 : 0),
                'remains_sub_communities_count' => $subscription->remains_sub_communities_count - ($channelLevel == ChannelLevel::SUBCOMMUNITY && !$updateChannel ? 1 : 0),
                'added_members_count'           => $subscription->added_members_count + abs($newMembersCount - $oldMembersCount),
                'remains_members_count'         => $subscription->remains_members_count - abs($newMembersCount - $oldMembersCount),
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while updating subscription counts for authenticated user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }
}
