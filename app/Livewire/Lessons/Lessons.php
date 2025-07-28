<?php

namespace App\Livewire\Lessons;

use App\Models\Course;
use Livewire\Component;

class Lessons extends Component
{
    public Course $course;
    public function render()
    {
        return view('livewire.lessons.lessons');
    }
}
