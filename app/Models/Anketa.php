<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anketa extends Model
{
    use HasFactory;

    protected $fillable = [
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',

        'user_id',
        'course_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
