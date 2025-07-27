<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class)->withPivot(['order'])
            ->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(user::class);
    }

}
