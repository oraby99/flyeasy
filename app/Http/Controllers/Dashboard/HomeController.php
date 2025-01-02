<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use App\Services\StatisticsService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    private StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $countUsers             = $this->statisticsService->countUsers();
        $countTeams             = $this->statisticsService->countTeams();
        $countCommunities       = $this->statisticsService->countCommunities();
        $countSubCommunities    = $this->statisticsService->countSubCommunities();
        return view('dashboard.home', compact(
            'countUsers',
            'countTeams',
            'countCommunities',
            'countSubCommunities'
        ));
    }
}
