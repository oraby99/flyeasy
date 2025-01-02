<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\PlanUser;

class PlanUserService extends Service
{
    public function all(): LengthAwarePaginator
    {
        return PlanUser::with(['plan', 'user'])->paginate(self::PERPAGE);
    }
}
