<?php

namespace App\Services;

use App\Enums\ChannelLevel;
use App\Models\Channel;

class SubCommunityService extends Service
{
    public function all()
    {
        return Channel::whereNotNull('parent_id')
            ->where('level', ChannelLevel::SUBCOMMUNITY)
            ->withCount('members')
            ->paginate(self::PERPAGE);
    }
}
