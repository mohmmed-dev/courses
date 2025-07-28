<?php

namespace App\Livewire\Lessons;

use App\Models\Lesson as ModelsLesson;
use Livewire\Component;

class Lesson extends Component
{
    public ModelsLesson $lesson;
    public function render()
    {
        return view('livewire.lessons.lesson');
    }
}
