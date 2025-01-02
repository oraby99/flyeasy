<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name', 'type', 'count', 'price', 'num_of_months'
    ];

    public function librarySections(): BelongsToMany
    {
        return $this->belongsToMany(LibrarySection::class, 'section_plans', 'plan_id', 'section_library_id');
    }
}
