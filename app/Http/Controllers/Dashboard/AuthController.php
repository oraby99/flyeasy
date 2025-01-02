<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Services\Dashboard\AuthService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

class AuthController
{
    public function login(): View|Application|Factory|ContractApplication
    {
        return view('dashboard.auth.login');
    }

    public function loginProcess(LoginRequest $request): Application|Redirector|RedirectResponse|ContractApplication
    {
        if((new AuthService)->login($request->validated()))
            return redirect(route('dashboard.home.index'));

        return redirect()->back();
    }

    public function logout(): Application|Redirector|RedirectResponse|ContractsApplication
    {
        auth()->logout();
        return redirect(route('dashboard.auth.login'));
    }
}
