<?php

namespace App\Livewire;

use App\Models\Course as ModelsCourse;
use Livewire\Component;

class Course extends Component
{
    public ModelsCourse $course;
    public function render()
    {
        return view('livewire.course');
    }
}
