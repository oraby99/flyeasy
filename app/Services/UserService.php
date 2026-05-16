<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Enums\ActivationStatus;
use Illuminate\Support\Arr;
use App\Enums\UserGroup;
use App\Models\User;
use Exception;
use App\Services\ChannelService;

class UserService extends Service
{


    public function all()
    {
        return User::where('group', UserGroup::USER)->paginate(self::PERPAGE);
    }
    

    public function update($user, $data): bool
    {
        DB::beginTransaction();
        try {
            $user->update($data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while update status of user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function getModeratorsAndGuests($searchData)
    {
        $search = Arr::get($searchData, 'search', '');
    
        // Return an empty collection if search is not provided or is empty
        if (!isset($search) || $search === '') {
            return collect([]);
        }
    
        // Split search term into keywords for multi-word search
        $keywords = explode(' ', $search);

        return User::query() // Removed auth id exclusion
            ->where(function ($q) use ($search, $keywords) {
                // Try to match the full string literally
                $q->where(function($full) use ($search) {
                    $full->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('country_code', 'like', '%' . $search . '%');
                });

                // OR match all keywords
                $q->orWhere(function ($andQ) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        if (empty($keyword)) continue;
                        $cleanKeyword = preg_replace('/[^0-9]/', '', $keyword);
                        
                        $andQ->where(function ($orQ) use ($keyword, $cleanKeyword) {
                            $orQ->where('name', 'like', '%' . $keyword . '%')
                                ->orWhere('email', 'like', '%' . $keyword . '%')
                                ->orWhere('phone', 'like', '%' . $keyword . '%')
                                ->orWhere('country_code', 'like', '%' . $keyword . '%')
                                ->orWhere('id', 'like', '%' . $keyword . '%');

                            if (!empty($cleanKeyword)) {
                                $orQ->orWhere(DB::raw("REGEXP_REPLACE(CONCAT(IFNULL(country_code, ''), IFNULL(phone, '')), '[^0-9]', '')"), 'like', '%' . $cleanKeyword . '%')
                                   ->orWhere(DB::raw("REGEXP_REPLACE(IFNULL(phone, ''), '[^0-9]', '')"), 'like', '%' . $cleanKeyword . '%');
                            }
                        });
                    }
                });
            })
            ->where(function ($q) use ($search) {
                $q->where([
                        'status' => ActivationStatus::ACTIVE,
                        'group'  => UserGroup::USER
                    ]);
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE ? THEN 1
                    WHEN phone LIKE ? THEN 2
                    WHEN country_code LIKE ? THEN 2
                    ELSE 3 
                END
            ", [$search . '%', $search . '%', $search . '%'])
            ->paginate(self::PERPAGE);
    }
    
}
