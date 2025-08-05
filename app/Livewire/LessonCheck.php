<?php

namespace App\Livewire;

use Livewire\Component;

class LessonCheck extends Component
{
    public $is_completed = false;
    public $id;

    public function done() {
        if(auth()->check() && !$this->is_completed) {
            auth()->user()->lessons()->updateExistingPivot($this->id,[
                'is_completed' => true
            ]);
        }
        $this->is_completed = true;
    }
    public function render()
    {
        return view('livewire.lesson-check');
    }
}
