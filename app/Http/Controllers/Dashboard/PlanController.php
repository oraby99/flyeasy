<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\LibrarySection;
use App\Services\PlanService;
use App\Models\Plan;

class PlanController extends Controller
{
    private PlanService $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $plans = $this->planService->all();
        return view('dashboard.plans.index', compact('plans'));
    }

    public function create(Plan $plan): View|Application|Factory|ContractApplication
    {
        $sections = LibrarySection::all();
        return view('dashboard.plans.create', compact('plan', 'sections'));
    }

    public function store(CreatePlanRequest $request): RedirectResponse
    {
        if($this->planService->store($request->validated()))
            return redirect()->route('dashboard.plans.index')->with('plan-created', __('dashboard.success-created'));

        return redirect()->back();
    }

    public function edit(Plan $plan): View|Application|Factory|ContractApplication
    {
        $plan->loadMissing('librarySections');
        $sections = LibrarySection::all();
        return view('dashboard.plans.edit', compact('plan', 'sections'));
    }

    public function update(Plan $plan, UpdatePlanRequest $request): RedirectResponse
    {
        if($this->planService->update($plan, $request->validated()))
            return redirect()->route('dashboard.plans.index')->with('plan-updated', __('dashboard.success-updated'));

        return redirect()->back();
    }
    public function destroy(Plan $plan): RedirectResponse
    {
        if($this->planService->destroy($plan))
            return redirect()->route('dashboard.plans.index')->with('plan-deleted', __('dashboard.success-deleted'));

        return redirect()->back();
    }
}
