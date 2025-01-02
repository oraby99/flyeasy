<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadFilesTrait;
use App\Enums\LibraryFileType;
use App\Models\LibrarySection;
use Illuminate\Support\Arr;
use App\Models\Library;
use Exception;

class LibraryService extends Service
{
    use UploadFilesTrait;

    public function all()
    {
        return Library::orderBy('id', 'desc')
            ->with('section')
            ->paginate(self::PERPAGE);
    }

    public function getLibrariesByType($data)
    {
        return Library::where('file_type', Arr::get($data, 'type'))->paginate(self::PERPAGE);
    }

    public function store($data): bool
    {
        DB::beginTransaction();
        try {
            $fileDetails = $this->uploadFile(Arr::get($data, 'file'), 'library/' . strtolower(LibraryFileType::getName(Arr::get($data, 'type'))), Arr::get($data, 'type'));
            Library::create(
                array_merge(
                    $fileDetails,
                    [
                        'section_id' => Arr::get($data, 'section_id')
                    ]
                )
            );
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while storing a file in library', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function update($data, $library): bool
    {
        DB::beginTransaction();
        try {
            if(Arr::exists($data, 'file')) {
                $this->deleteFile($library->full_path_url);
                $fileDetails = $this->uploadFile(Arr::get($data, 'file'), 'library/' . strtolower(LibraryFileType::getName(Arr::get($data, 'type'))), Arr::get($data, 'type'));
                $library->update(
                    array_merge(
                        $fileDetails,
                        [
                            'section_id' => Arr::get($data, 'section_id')
                        ]
                    )
                );
            } else {
                $library->update(['file_type' => Arr::get($data, 'type')]);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while updating a file in library', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function destroy($library): bool
    {
        DB::beginTransaction();
        try {
            $this->deleteFile($library->full_file_path);
            $library->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while deleting a file in library', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function getBySection($data)
    {
        $type = Arr::get($data, 'type');
        return LibrarySection::where('id', Arr::get($data, 'section_id'))
            ->with(['files' => function ($q) use ($type) {
                return $q->where('file_type', $type);
            }])
            ->first();
    }

    public function getAllSections()
    {
        $userId = auth()->id();
        return LibrarySection::leftJoin('user_sections', function ($join) use ($userId) {
                    $join->on('library_sections.id', '=', 'user_sections.section_library_id')
                        ->where('user_sections.user_id', $userId);
                })
                ->select(
                    'library_sections.*',
                    DB::raw('
                        CASE
                            WHEN
                                user_sections.user_id IS NOT NULL
                            THEN
                                1
                            ELSE
                                0
                            END
                        AS
                        available_for_authenticated
                    ')
                )
                ->paginate(self::PERPAGE);
    }
}
