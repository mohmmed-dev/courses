<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'avatar_id',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function avatar() {
        return $this->belongsTo(Avatar::class);
    }

    public function myPaths() {
        return $this->hasMany(Path::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }


    public function courses() {
        return $this->belongsToMany(Course::class)->withPivot(['id','is_completed','is_favorite','is_stop','value'])->withTimestamps();
    }

    public function lessons() {
        return $this->belongsToMany(Lesson::class,'user_lesson')
            ->withPivot(['id', 'is_completed'])
            ->withTimestamps();
    }

    public function paths() {
        return $this->belongsToMany(Path::class)
            ->withPivot(['id','is_completed','is_favorite','value','review'])
            ->withTimestamps();
    }

    public function getCourseProgress(Course $course)
    {
        $completedCount = $this->lessons()
            ->wherePivot('is_completed', true)
            ->whereIn('lesson_id', function ($query) use ($course) {
                $query->select('id')->from('lessons')->where('course_id', $course->id);
            })
            ->count();

        // الحصول على إجمالي عدد الدروس في الكورس
        $totalLessonsCount = $course->lessons()->count();

        // حساب عدد الدروس المتبقية
        $remainingCount = $totalLessonsCount - $completedCount;

        return [
            'completed' => $completedCount,
            'remaining' => $remainingCount,
            'total' => $totalLessonsCount,
        ];
    }

    public function getPathsProgress(Course $course)
    {
        $completedCount = $this->courses()
            ->wherePivot('is_completed', true)
           // ->whereIn('_id', function ($query) use ($course) {
         //      $query->select('id')->from('lessons')->where('course_id', $course->id);
          //  })
            ->count();

        // الحصول على إجمالي عدد الدروس في الكورس
        $totalLessonsCount = $course->lessons()->count();

        // حساب عدد الدروس المتبقية
        $remainingCount = $totalLessonsCount - $completedCount;

        return [
            'completed' => $completedCount,
            'remaining' => $remainingCount,
            'total' => $totalLessonsCount,
        ];
    }

}
