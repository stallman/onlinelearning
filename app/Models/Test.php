<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'allocated_time',
        'minimal_right_questions',
        'is_visible',
    ];

    public function questions(){
        return $this->hasMany(Question::class)->orderBy('order');
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
