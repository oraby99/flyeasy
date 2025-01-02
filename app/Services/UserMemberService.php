<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\ChannelMember;
use Illuminate\Support\Arr;
use App\Enums\ChannelLevel;
use App\Enums\YesOrNo;
use Exception;

class UserMemberService extends Service
{
    public function all($data)
    {
        try {
            $ignoredMemberId = Arr::get($data, 'ignored_member_id');
            $search = Arr::get($data, 'search');
    
            // Return empty collection if no search key is provided
            if (empty($search)) {
                return collect([]); // Or return a paginated empty array if required
            }
    
            $channels = ChannelMember::pluck('channel_id');
    
            return ChannelMember::whereIn('channel_id', $channels)
                    ->where('member_id', '!=', auth()->id())
                    ->when($ignoredMemberId, function ($q) use ($ignoredMemberId) {
                        return $q->where('member_id', '!=', $ignoredMemberId);
                    })
                    ->whereHas('user', function ($q) use ($search) {
                        return $q->where(function ($query) use ($search) {
                            $query->where('users.name', 'like', '%' . $search . '%')
                                ->orWhere('users.email', 'like', '%' . $search . '%')
                                ->orWhere('users.work_id', 'like', '%' . $search . '%')
                                ->orWhere('users.phone', 'like', '%' . $search . '%');
                        });
                    })
                    ->groupBy('member_id')
                    ->paginate(self::PERPAGE);
                    
        } catch (Exception $e) {
            Log::error('Error while getting all channels for authenticated user', [
                'error' => $e->getMessage(),
                'trace' => $e->__toString()
            ]);
            return false;
        }
    }
    
}
