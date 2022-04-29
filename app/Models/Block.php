<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'parent_id',
        'course_id',
        'order',
        'literature',
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['is_read']);
    }

    public function files(){
        return $this->belongsToMany(File::class)->withTimestamps();
    }

    public function materials(){
        return $this->belongsToMany(File::class)->where('type', '=', 'material');
    }

    public function presentations(){
        return $this->belongsToMany(File::class)->where('type', '=', 'presentation');
    }

    public function getChildBlocksAttribute(){
        return $this->hasMany(Block::class, 'parent_id', 'id')->get();
    }

    public function course(){
        return$this->belongsTo(Course::class);
    }

}
