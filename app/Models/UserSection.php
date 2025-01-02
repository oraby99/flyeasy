<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSection extends Model
{
    protected $table = 'user_sections';

    protected $fillable = [
        'user_id', 'section_library_id'
    ];
}
