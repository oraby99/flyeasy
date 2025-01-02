<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use App\Http\Requests\CreateLibrarySectionRequest;
use App\Http\Requests\UpdateLibrarySectionRequest;
use App\Services\LibrarySectionService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\LibrarySection;

class LibrarySectionController extends Controller
{
    private LibrarySectionService $librarySectionService;

    public function __construct(LibrarySectionService $librarySectionService)
    {
        $this->librarySectionService = $librarySectionService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $librarySections = $this->librarySectionService->all();
        return view('dashboard.library.sections.index', compact('librarySections'));
    }

    public function create(LibrarySection $librarySection): View|Application|Factory|ContractApplication
    {
        return view('dashboard.library.sections.create', compact('librarySection'));
    }

    public function store(CreateLibrarySectionRequest $request): RedirectResponse
    {
        if($this->librarySectionService->store($request->validated()))
            return redirect()->route('dashboard.library.sections.index')->with('library-sections-created', __('dashboard.success-created'));

        return redirect()->back();
    }

    public function edit(LibrarySection $librarySection): View|Application|Factory|ContractApplication
    {
        return view('dashboard.library.sections.edit', compact('librarySection'));
    }

    public function update(LibrarySection $librarySection, UpdateLibrarySectionRequest $request): RedirectResponse
    {
        if($this->librarySectionService->update($librarySection, $request->validated()))
            return redirect()->route('dashboard.library.sections.index')->with('library-sections-updated', __('dashboard.success-updated'));

        return redirect()->back();
    }
}
