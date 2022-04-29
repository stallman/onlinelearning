<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestToCourse extends Model
{

    use HasFactory;

    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'email',
        'request_file',
        'course_id',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
