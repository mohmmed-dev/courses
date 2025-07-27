<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'category_id',
        'title',
        'slug',
        'description',
        'path_image',
        'youtube_path',
        'language',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function paths() {
        return $this->belongsToMany(Path::class,'course_paths')->withPivot(['order'])
            ->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(user::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

}
