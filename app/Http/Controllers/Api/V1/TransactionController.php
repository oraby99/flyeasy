<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Plan;
use App\Enums\PlanTypeEnum;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plan_id'  => 'required',
            'amount'   => 'required',
            'currency' => 'required',
        ]);
        $plan = Plan::findOrFail($validatedData['plan_id']);
        $subscription = Subscription::where('user_id', auth()->id())->first();
        if ($plan->type == PlanTypeEnum::TEAM) {
            $subscription->update(['remains_teams_count'           => $subscription->remains_teams_count            + $plan->count]);
        } elseif ($plan->type == PlanTypeEnum::COMMUNITY) {
            $subscription->update(['remains_communities_count'     => $subscription->remains_communities_count      + $plan->count]);
        } elseif ($plan->type == PlanTypeEnum::SUBCOMMUNITY) {
            $subscription->update(['remains_sub_communities_count' => $subscription->remains_sub_communities_count  + $plan->count]);
        } elseif ($plan->type == PlanTypeEnum::MEMBER) {
            $subscription->update(['remains_members_count'         => $subscription->remains_members_count          + $plan->count]);
        }
        $transaction = Transaction::create([
            'user_id'  => auth()->id(),
            'plan_id'  => $validatedData['plan_id'],
            'amount'   => $validatedData['amount'],
            'currency' => $validatedData['currency'],
        ]);
        return response()->json(['status' => 'success', 'data' => $transaction], 201);
    }

}
