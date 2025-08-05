<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'order',
        'title',
        'slug',
        'thumbnail',
        'path_video',
        'views',
        'hours',
        'minutes',
        'second',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_lesson')
            ->withPivot(['id', 'is_completed'])
            ->withTimestamps();
    }
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getComments() {
        return $this->comments()->where("parent_id" , 0)->get();
    }

}
