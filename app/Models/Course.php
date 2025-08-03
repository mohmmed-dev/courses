<?php

namespace App\Models;

use App\Helpers\Slug;
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
        'thumbnail',
        'youtube_id',
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
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function paths() {
        return $this->belongsToMany(Path::class)->withPivot(['order'])
            ->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(user::class)->withPivot(['id','is_completed','is_favorite','is_stop','value'])->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function asyncLessons(array $lessons): void
    {
        $existingIds = [];
        foreach ($lessons as $lessonData) {
            $uniqueKey = ['path_video' => $lessonData['path_video']];
            $existing = $this->lessons()->where($uniqueKey)->first();
            if ($existing) {
                $lessonData['slug'] = $existing->slug;
            } else {
                $lessonData['slug'] = Slug::uniqueSlug($lessonData['title'],'lessons');
            }
            $lesson = $this->lessons()->updateOrCreate(
                $uniqueKey,
                $lessonData
            );
            $existingIds[] = $lesson->path_video;
        }
            $this->lessons()->whereNotin('path_video',$existingIds)->delete();
    }

    //  public function rate() {
    //     return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value') / $this->ratings()->count(): 0 ;
    // }


    public function rate() {
        if ($this->users->isEmpty()) {
            return 0;
        }
        $totalValue = $this->users()->wherePivot('is_completed', 1)->sum('value');
        if ($totalValue == 0) {
            return 0;
        }
        $completedCount = $this->users()->wherePivot('is_completed', 1)->count();
        return $completedCount > 0 ? $totalValue / $completedCount : 0;
    }
}
