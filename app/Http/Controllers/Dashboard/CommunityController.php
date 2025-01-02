<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Services\CommunityService;
use App\Models\Channel;

class CommunityController extends Controller
{
    private CommunityService $communityService;

    public function __construct(CommunityService $communityService)
    {
        $this->communityService = $communityService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $channels = $this->communityService->all();
        return view('dashboard.channels.communities.index', compact('channels'));
    }

    public function show(Channel $channel): View|Application|Factory|ContractApplication
    {
        $channel->loadMissing(['users', 'subCommunities']);
        return view('dashboard.channels.communities.show', compact('channel'));
    }
}
