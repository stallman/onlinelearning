<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'education_level_id',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
