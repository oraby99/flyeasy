<?php

namespace App\Services;

use App\Enums\ChannelLevel;
use App\Models\Channel;

class CommunityService extends Service
{
    public function all()
    {
        return Channel::whereNotNull('parent_id')
            ->where('level', ChannelLevel::COMMUNITY)
            ->withCount('members')
            ->paginate(self::PERPAGE);
    }
}
