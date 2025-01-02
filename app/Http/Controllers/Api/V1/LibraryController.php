<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\getLibraryBySectionRequest;
use App\Http\Requests\CheckLibraryTypeRequest;
use App\Http\Resources\LibrarySectionResource;
use App\Http\Resources\LibraryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\LibraryService;
use App\Enums\LibraryFileType;
use App\Models\LibrarySection;

class LibraryController extends Controller
{
    private LibraryService $libraryService;

    public function __construct(LibraryService $libraryService)
    {
        $this->libraryService = $libraryService;
    }

    public function getLibrariesBySection(getLibraryBySectionRequest $request): JsonResponse
    {
        if($section = $this->libraryService->getBySection($request->validated()))
            return $this->success(LibraryResource::collection($section->files));

        return $this->failed();
    }

    public function getSections(): JsonResponse
    {
        if($sections = $this->libraryService->getAllSections())
            return $this->success(LibrarySectionResource::collection($sections));

        return $this->failed();
    }
}
