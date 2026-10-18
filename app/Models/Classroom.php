<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    protected $fillable = ['academic_year', 'year_level', 'section', 'total_students'];

    public function eventClassrooms(): HasMany
    {
        return $this->hasMany(EventClassroom::class);
    }
}
