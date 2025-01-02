<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use App\Http\Requests\CreateLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Services\LibraryService;
use App\Models\LibrarySection;
use App\Models\Library;

class LibraryController
{
    private LibraryService $LibraryService;

    public function __construct(LibraryService $LibraryService)
    {
        $this->LibraryService = $LibraryService;
    }

    public function index(): View|Application|Factory|ContractApplication
    {
        $libraryFiles = $this->LibraryService->all();
        return view('dashboard.library.index', compact('libraryFiles'));
    }

    public function create(): View|Application|Factory|ContractApplication
    {
        $sections = LibrarySection::all();
        return view('dashboard.library.create', compact('sections'));
    }

    public function store(CreateLibraryRequest $request): RedirectResponse
    {
        if($this->LibraryService->store($request->validated()))
            return redirect()->route('dashboard.library.index')->with('library-created', __('dashboard.success-created'));

        return redirect()->back();
    }

    public function edit(Library $library): View|Application|Factory|ContractApplication
    {
        $sections = LibrarySection::all();
        return view('dashboard.library.edit', compact('library', 'sections'));
    }

    public function update(UpdateLibraryRequest $request, Library $library): RedirectResponse
    {
        if($this->LibraryService->update($request->validated(), $library))
            return redirect()->route('dashboard.library.index')->with('library-updated', __('dashboard.success-updated'));

        return redirect()->back();
    }

    public function destroy(Library $library): RedirectResponse
    {
        if($this->LibraryService->destroy($library))
            return redirect()->route('dashboard.library.index')->with('library-deleted', __('dashboard.success-deleted'));

        return redirect()->back();
    }
}
