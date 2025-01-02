<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use App\Http\Requests\UpdatePlanRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Services\SettingService;
use App\Models\Plan;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function edit(): View|Application|Factory|ContractApplication
    {
        $settings = $this->settingService->all();
        return view('dashboard.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        if($this->settingService->update($request->except(['_token', '_method'])))
            return redirect()->route('dashboard.settings.edit')->with('settings-updated', __('dashboard.success-updated'));

        return redirect()->back();
    }
}
