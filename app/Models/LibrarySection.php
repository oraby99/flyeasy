<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class LibrarySection extends Model
{
    protected $table = 'library_sections';

    protected $fillable = [
        'name'
    ];

    public function files(): HasMany
    {
        return $this->hasMany(Library::class, 'section_id');
    }
}
