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
      $lessons = $this->course->lessons()->paginate(10);
        return view('livewire.lessons.lessons',["lessons" => $lessons]);
    }
}
