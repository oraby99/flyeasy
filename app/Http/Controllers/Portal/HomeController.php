<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View|Application|Factory|ContractApplication
    {
        return view('portal.home');
    }
    public function conditions(): View|Application|Factory|ContractApplication
    {
        return view('portal.conditions');
    }
    public function policy(): View|Application|Factory|ContractApplication
    {
        return view('portal.policy');
    }
    
}
