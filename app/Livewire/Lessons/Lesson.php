<?php

namespace App\Livewire\Lessons;

use App\Models\Lesson as ModelsLesson;
use App\Models\User;
use Livewire\Component;

class Lesson extends Component
{
    public ModelsLesson $lesson;
    public $user;
    public $check;
    public $show = false;

    public function mount() {
        $this->show = request()->is("lesson/{$this->lesson->slug}");
        $this->user = auth()->user() ?? null;
        // if(!empty($this->user) ) {
        //     $this->check = $this->user->lessons()->where("lesson_id",$this->lesson->id)->get();
        //     dump($this->check);
        // }
    }

    public function view() {
        if(empty($this->user)) {
            return redirect()->route('lesson.show',$this->lesson->slug);
        }
        $lessonPivot = $this->user->lessons()->where("lesson_id",$this->lesson->id)->get();
        if(count($lessonPivot) == 0) {
            $this->user->lessons()->attach($this->lesson->id);
        }
        return redirect()->route('lesson.show',$this->lesson->slug);
    }

    public function render()
    {
        return view('livewire.lessons.lesson');
    }
}
