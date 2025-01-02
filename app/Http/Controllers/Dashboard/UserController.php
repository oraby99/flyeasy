<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use App\Http\Requests\UpdateUserStatusRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $filters = request()->all();
        $users = $this->userService->all($filters);
        return view('dashboard.users.index', compact('users'));
    }
    
    

    public function show(User $user): View|Application|Factory|ContractApplication
    {
        $user->loadMissing(['teams', 'communities', 'subCommunities']);
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user): View|Application|Factory|ContractApplication
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(User $user, UpdateUserStatusRequest $request): RedirectResponse
    {
        if($this->userService->update($user, $request->validated()))
            return redirect()->route('dashboard.users.index')->with('user-updated', __('dashboard.success-updated'));

        return redirect()->back();
    }
}
