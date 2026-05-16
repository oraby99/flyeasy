<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\ChannelMember;
use Illuminate\Support\Arr;
use App\Enums\ChannelLevel;
use App\Enums\YesOrNo;
use App\Enums\ActivationStatus;
use App\Enums\UserGroup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class UserMemberService extends Service
{
    public function all($data)
    {
        try {
            $ignoredMemberId = Arr::get($data, 'ignored_member_id');
            $search = Arr::get($data, 'search');
    
            // Return empty collection if no search key is provided
            if (!isset($search) || $search === '') {
                return collect([]);
            }

            // Split search term into keywords for multi-word search
            $keywords = explode(' ', $search);
    
            $query = User::query() // Removed auth id exclusion
                ->where(function ($q) use ($search, $keywords) {
                    // Try to match the full string literally across main columns
                    $q->where(function($full) use ($search) {
                        $full->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%')
                            ->orWhere('country_code', 'like', '%' . $search . '%');
                    });

                    // OR match all keywords across any column
                    $q->orWhere(function ($andQ) use ($keywords) {
                        foreach ($keywords as $keyword) {
                            if (empty($keyword)) continue;
                            $cleanKeyword = preg_replace('/[^0-9]/', '', $keyword);
                            
                            $andQ->where(function ($orQ) use ($keyword, $cleanKeyword) {
                                $orQ->where('name', 'like', '%' . $keyword . '%')
                                    ->orWhere('email', 'like', '%' . $keyword . '%')
                                    ->orWhere('work_id', 'like', '%' . $keyword . '%')
                                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                                    ->orWhere('country_code', 'like', '%' . $keyword . '%')
                                    ->orWhere('company', 'like', '%' . $keyword . '%')
                                    ->orWhere('id', 'like', '%' . $keyword . '%');

                                if (!empty($cleanKeyword)) {
                                    $orQ->orWhere(DB::raw("REGEXP_REPLACE(CONCAT(IFNULL(country_code, ''), IFNULL(phone, '')), '[^0-9]', '')"), 'like', '%' . $cleanKeyword . '%')
                                       ->orWhere(DB::raw("REGEXP_REPLACE(IFNULL(phone, ''), '[^0-9]', '')"), 'like', '%' . $cleanKeyword . '%');
                                }
                            });
                        }
                    });
                })
                ->where('status', ActivationStatus::ACTIVE)
                ->where('group', UserGroup::USER);

            // Priority ordering: Starts with > Contains
            $query->orderByRaw("
                CASE 
                    WHEN name LIKE ? THEN 1
                    WHEN phone LIKE ? THEN 2
                    WHEN country_code LIKE ? THEN 2
                    ELSE 3 
                END
            ", [$search . '%', $search . '%', $search . '%']);

            if ($ignoredMemberId) {
                $query->where('id', '!=', $ignoredMemberId);
            }

            return $query->paginate(self::PERPAGE);
                    
        } catch (Exception $e) {
            Log::error('Error while getting all channels for authenticated user', [
                'error' => $e->getMessage(),
                'trace' => $e->__toString()
            ]);
            return false;
        }
    }
    
}
