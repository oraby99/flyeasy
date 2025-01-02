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
        if (empty($search)) {
            return collect([]); // You can also return paginate([]) if needed for pagination
        }
    
        return User::where(function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                              ->orWhere('email', 'like', '%' . $search . '%')
                              ->orWhere('phone', 'like', '%' . $search . '%');
                        })
                    ->where(function ($q) {
                        $q->where([
                                'status' => ActivationStatus::ACTIVE,
                                'group'  => UserGroup::USER
                            ])
                            ->where('id', '!=', auth()->id())
                            ->whereNotNull('email_verified_at');
                    })
                    ->paginate(self::PERPAGE);
    }
    
}
