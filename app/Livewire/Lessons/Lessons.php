<?php

namespace App\Livewire\Lessons;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Lessons extends Component
{
    use WithPagination;
    public Course $course;

    public function render()
    {
        $lessons = $this->course->lessons()->withCount(['users as is_completed' => function ($query) {
                $query->where('user_lesson.is_completed', true)
                    ->where('user_lesson.user_id', auth()->id());
            }])->paginate(10);
        return view('livewire.lessons.lessons',["lessons" => $lessons]);
    }
}
