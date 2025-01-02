<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class LibrarySectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                            => $this->id,
            'name'                          => $this->name,
            'available_for_authenticated'   => $this->when(isset($this->available_for_authenticated), (bool) $this->available_for_authenticated)
        ];
    }
}
