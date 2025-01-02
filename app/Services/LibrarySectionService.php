<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\LibrarySection;
use Exception;

class LibrarySectionService extends Service
{
    public function all()
    {
        return LibrarySection::paginate(self::PERPAGE);
    }

    public function store($data): bool
    {
        DB::beginTransaction();
        try {
            LibrarySection::create($data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while creating data of a library section', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }

    public function update($librarySection, $data): bool
    {
        DB::beginTransaction();
        try {
            $librarySection->update($data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while updating data of a library section', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
