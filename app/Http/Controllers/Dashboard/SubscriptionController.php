<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Services\PlanUserService;

class SubscriptionController extends Controller
{
    private PlanUserService $planUserService;

    public function __construct(PlanUserService $planUserService)
    {
        $this->planUserService = $planUserService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $subscriptions = $this->planUserService->all();
        return view('dashboard.subscriptions.index', compact('subscriptions'));
    }
}
