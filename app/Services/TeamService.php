<?php

namespace App\Services;

use App\Enums\ChannelLevel;
use App\Models\Channel;

class TeamService extends Service
{
    public function all()
    {
        return Channel::whereNull('parent_id')
            ->where('level', ChannelLevel::TEAM)
            ->withCount('members')
            ->paginate(self::PERPAGE);
    }
}
