<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Enums\PlanTypeEnum;
use App\Models\Plan;
use Exception;

class PlanService extends Service
{
    public function all()
    {
        return Plan::withCount('librarySections')->orderBy('created_at', 'desc')->paginate(self::PERPAGE);
    }
    const PERPAGE = 10;
    public function showForApi($userDiscount): LengthAwarePaginator
    {
        $plans = Plan::with('librarySections')->orderBy('created_at', 'desc')->paginate(self::PERPAGE);
        foreach ($plans as $plan) {
            $plan->price = ($plan->price * ($userDiscount / 100));
        }
        return $plans;
    }
    public function store($data): bool
    {
        DB::beginTransaction();
        try {
            if(Arr::get($data, 'type') == PlanTypeEnum::LIBRARY) {
                $data = Arr::except($data, ['count']);
            } else {
                $data = Arr::except($data, ['sections', 'num_of_months']);
            }

            $plan = Plan::create($data);
            if(Arr::exists($data, 'sections')) {
                $plan->librarySections()->sync(Arr::get($data, 'sections'));
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while creating data of a plan', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
    public function update($plan, $data): bool
    {
        DB::beginTransaction();
        try {
            if(Arr::get($data, 'type') == PlanTypeEnum::LIBRARY) {
                $data = Arr::except($data, ['count']);
            } else {
                $data = Arr::except($data, ['sections', 'num_of_months']);
            }

            $plan->update($data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while updating data of plan', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
    public function destroy($library): bool
    {
        DB::beginTransaction();
        try {
            $library->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while deleting a file in library', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
