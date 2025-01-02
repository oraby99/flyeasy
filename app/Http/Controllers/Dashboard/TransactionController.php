<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Contracts\View\View;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $transactions = $this->transactionService->all();
        return view('dashboard.transactions.index', compact('transactions'));
    }
}
