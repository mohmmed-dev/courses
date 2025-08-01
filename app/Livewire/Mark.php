<?php

namespace App\Livewire;

use Livewire\Component;

class Mark extends Component
{
    public $id;
    public $is_completed = false;
    public $is_favorite = false;

    public $mark;

    public function mount() {
        $this->check();
    }

    public function favorite() {
        $courseId = $this->id;
        $user = auth()->user()->courses();
        $value = $this->is_favorite ==  0 ? true : false;
        if(!$this->is_completed && !$this->is_favorite && empty($mark)) {
            $user->toggle([$this->id => [
                'is_favorite' => true,
            ]]);
        } else {
            if($value) {
                $user->updateExistingPivot($courseId, [
                    'is_favorite' => 1
                ]);
            } else {
                $user->updateExistingPivot($courseId, [
                    'is_favorite' => 0
                ]);
            }
        }
    }

    public function myCourse() {
        $courseId = $this->id;
        $user = auth()->user()->courses();
        $value = $this->is_completed ==  0 ? true : false;
        if(!$this->markCheck && !$this->is_completed && empty($mark)) {
            $user->toggle([$this->id => [
                'is_favorite' => true,
            ]]);
        } else {
            if($value) {
                $user->updateExistingPivot($courseId, [
                    'is_favorite' => 1
                ]);
            } else {
                $user->updateExistingPivot($courseId, [
                    'is_favorite' => 0
                ]);
            }
        }
        $this->is_completed = $value;
    }


    public function check() {
        $mark = auth()->user()->courses()->where('course_id', $this->id)->first();

        if($mark) {
            $this->mark = $mark;
            $this->is_completed =  $mark->pivot->is_completed;
            $this->is_favorite =  $mark->pivot->is_favorite;
        }
    }
    public function render()
    {
        return view('livewire.mark');
    }
}
