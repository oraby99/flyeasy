<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Services\TeamService;
use App\Models\Channel;

class TeamController extends Controller
{
    private TeamService $TeamService;

    public function __construct(TeamService $TeamService)
    {
        $this->TeamService = $TeamService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $channels = $this->TeamService->all();
        return view('dashboard.channels.teams.index', compact('channels'));
    }

    public function show(Channel $channel): View|Application|Factory|ContractApplication
    {
        $channel->loadMissing(['users', 'communities', 'subCommunities']);
        return view('dashboard.channels.teams.show', compact('channel'));
    }
}
