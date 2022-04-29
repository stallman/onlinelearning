<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use HasFactory;

    public const TYPES = [
        'one' => ['title' => 'Один верный ответ', 'type' => 'one'],
        'several' => ['title' => 'Несколько верных ответов', 'type' => 'several'],
        'right_order' => ['title' => 'Верный порядок', 'type' => 'right_order'],
        'text' => ['title' => 'Текстовый ответ', 'type' => 'text'],
    ];

    protected $fillable = [
        'text',
        'test_id',
        'type',
        'order',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'id',
    ];

    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getAnsweredAttribute(){
        return $this->belongsToMany(User::class)
            ->where('user_id', '=', Auth::id())->first(['is_right']);
    }


}
