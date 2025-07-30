<?php

namespace App\Livewire;

use Livewire\Component;

class Mark extends Component
{
    public $id;
    public $markCheck = false;
    public $courseCheck = false;
    public $mark;
    public function mount() {
        $this->check();
    }

    public function myMark() {
        $courseId = $this->id;
        $user = auth()->user()->courses();
        $value = $this->markCheck ==  0 ? true : false;
        if(!$this->markCheck && !$this->courseCheck && empty($mark)) {
            $user->toggle([$this->id => [
                'nomination' => true,
            ]]);
        } else {
            if($value) {
                $user->updateExistingPivot($courseId, [
                    'nomination' => 1
                ]);
            } else {
                $user->updateExistingPivot($courseId, [
                    'nomination' => 0
                ]);
            }
        }
        $this->markCheck = $value;
    }

    public function myCourse() {
        $courseId = $this->id;
        $user = auth()->user()->courses();
        $value = $this->courseCheck ==  0 ? true : false;
        if(!$this->markCheck && !$this->courseCheck && empty($mark)) {
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
        $this->courseCheck = $value;
    }

    public function check() {
        $mark = auth()->user()->courses()->where('course_id', $this->id)->first();

        if($mark) {
            $this->mark = $mark;
            $this->courseCheck =  $mark->pivot->nomination;
            $this->markCheck =  $mark->pivot->is_favorite;
        }
    }
    public function render()
    {
        return view('livewire.mark');
    }
}
