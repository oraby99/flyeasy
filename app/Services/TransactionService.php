<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use App\Enums\PlanTypeEnum;
use Illuminate\Support\Arr;
use App\Models\Transaction;
use App\Models\UserSection;
use App\Models\PlanUser;
use Exception;

class TransactionService extends Service
{
    public function all()
    {
        return Transaction::paginate(self::PERPAGE);
    }

    public function store($data): bool
    {
        DB::beginTransaction();
        try {
            $planUser = PlanUser::where('user_id', auth()->id())->with(['plan', 'plan.librarySections'])->orderBy('id', 'desc')->first();
            Transaction::create([
                'user_id'                   => auth()->id(),
                'plan_id'                   => $planUser->plan->id,
                'amount'                    => Arr::get($data, 'amount'),
                'payment_transaction_id'    => Arr::get($data, 'transaction_id'),
                'currency'                  => Arr::get($data, 'currency')
            ]);

            if($planUser->plan->type == PlanTypeEnum::TEAM) {
                Subscription::where('user_id', auth()->id())->update(['remains_teams_count' => $planUser->plan->count]);
            } elseif ($planUser->plan->type == PlanTypeEnum::COMMUNITY) {
                Subscription::where('user_id', auth()->id())->update(['remains_communities_count' => $planUser->plan->count]);
            } elseif ($planUser->plan->type == PlanTypeEnum::SUBCOMMUNITY) {
                Subscription::where('user_id', auth()->id())->update(['remains_sub_communities_count' => $planUser->plan->count]);
            } elseif ($planUser->plan->type == PlanTypeEnum::MEMBER) {
                Subscription::where('user_id', auth()->id())->update(['remains_members_count' => $planUser->plan->count]);
            } else {
                $sections = [];
                foreach($planUser->plan->librarySections as $section) {
                    $sections[] = [
                        'user_id'               => auth()->id(),
                        'section_library_id'    => $section->id,
                        'created_at'            => now(),
                        'updated_at'            => now()
                    ];
                }
                UserSection::insert($sections);
            }

            PlanUser::create([
                'plan_id'   => $planUser->plan->id,
                'user_id'   => auth()->id(),
                'end_at'    => $planUser->plan->type == PlanTypeEnum::LIBRARY ? now()->addMonths($planUser->plan->num_of_months)->format('d/m/Y') : null
            ]);

            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while storing a transaction after payment done', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }
}
