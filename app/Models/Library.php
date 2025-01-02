<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use SoftDeletes;

    protected $table = 'libraries';

    protected $fillable = [
        'full_file_path', 'file_path', 'file_name', 'file_extension',
        'file_size', 'file_type', 'section_id'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(LibrarySection::class, 'section_id');
    }
}
