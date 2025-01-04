<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class LibraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'full_file_path'    => url('storage/app/' . $this->full_file_path),
            'file_path'         => $this->file_path,
            'file_name'         => $this->file_name,
            'file_extension'    => $this->file_extension,
            'file_size'         => $this->file_size,
            'file_type'         => $this->file_type
        ];
    }
}
