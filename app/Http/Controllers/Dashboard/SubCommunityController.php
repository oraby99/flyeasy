<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Services\SubCommunityService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Channel;

class SubCommunityController extends Controller
{
    private SubCommunityService $subCommunityService;

    public function __construct(SubCommunityService $subCommunityService)
    {
        $this->subCommunityService = $subCommunityService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $channels = $this->subCommunityService->all();
        return view('dashboard.channels.sub-communities.index', compact('channels'));
    }

    public function show(Channel $channel): View|Application|Factory|ContractApplication
    {
        $channel->loadCount('users');
        return view('dashboard.channels.sub-communities.show', compact('channel'));
    }
}
