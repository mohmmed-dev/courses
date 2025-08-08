<?php

namespace App\Livewire\Lessons;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Lessons extends Component
{
    use WithPagination;
    public Course $course;
    public $progress;

    public function mount() {
        if(empty($this->course->completed_lessons_count) && empty($this->course->lessons_count)) {
            $this->course->loadCount(["users", "lessons", "lessons as completed_lessons_count" => function($query) {
                $query->whereHas('users', function ($q) {
                    $q->where('user_id', auth()->id())->where("is_completed", true);
                });
            }]);
        }
        $this->progress = [
            'completed' => $this->course->completed_lessons_count,
            'remaining' => $this->course->lessons_count - $this->course->completed_lessons_count,
            'total' => $this->course->lessons_count
        ];
    }

    public function render()
    {
        $lessons = $this->course->lessons()->withCount(['users as is_completed' => function ($query) {
                $query->where('user_lesson.is_completed', true)
                    ->where('user_lesson.user_id', auth()->id());
            }])->paginate(10);
        return view('livewire.lessons.lessons',["lessons" => $lessons]);
    }
}
