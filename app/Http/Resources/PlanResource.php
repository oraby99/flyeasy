<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PlanResource extends JsonResource
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
            'name'              => $this->name,
            'type'              => strtolower(\App\Enums\PlanTypeEnum::getName($this->type)),
            'count'             => $this->count,
            'price'             => $this->price,
            'num_of_months'     => $this->num_of_months,
            'library_sections'  => $this->librarySections != null ? LibrarySectionResource::collection($this->librarySections) : []
        ];
    }
}
