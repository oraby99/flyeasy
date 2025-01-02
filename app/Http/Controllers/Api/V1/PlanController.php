<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use Illuminate\Http\JsonResponse;
use App\Services\PlanService;

class PlanController extends Controller
{
    private PlanService $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function all(): JsonResponse
    {
        if($plans = $this->planService->showForApi(auth()->user()->discount))
            return $this->success(PlanResource::collection($plans));

        return $this->failed();
    }
}
