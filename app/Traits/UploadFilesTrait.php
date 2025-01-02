<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadFilesTrait
{
    public function uploadFile($file, $path, $type = null): array
    {
        $randomString   = Str::slug(Str::random(10));
        $fileName       = $randomString . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $fileName);

        return [
            'full_file_path'    => $path . '/' . $fileName,
            'file_path'         => $path,
            'file_name'         => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'file_extension'    => $file->extension(),
            'file_size'         => $file->getSize(),
            'file_type'         => $type
        ];
    }

    public function deleteFile($file): void
    {
        Storage::delete($file);
    }
}
