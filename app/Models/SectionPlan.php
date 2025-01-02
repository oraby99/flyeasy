<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionPlan extends Model
{
    protected $table = 'section_plans';

    protected $fillable = [
        'plan_id', 'section_library_id'
    ];
}
