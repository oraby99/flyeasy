<?php

namespace App\Services;

use App\Enums\ChannelLevel;
use App\Enums\UserGroup;
use App\Models\Channel;
use App\Models\User;

class StatisticsService
{
    public function countUsers()
    {
        return User::where('group', UserGroup::USER)->count();
    }

    public function countTeams()
    {
        return Channel::where('level', ChannelLevel::TEAM)
            ->whereNull('parent_id')
            ->count();
    }

    public function countCommunities()
    {
        return Channel::where('level', ChannelLevel::COMMUNITY)
            ->whereNotNull('parent_id')
            ->count();
    }

    public function countSubCommunities()
    {
        return Channel::where('level', ChannelLevel::SUBCOMMUNITY)
            ->whereNotNull('parent_id')
            ->count();
    }
}
