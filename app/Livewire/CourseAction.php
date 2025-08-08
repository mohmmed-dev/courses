<?php

namespace App\Livewire;

use Livewire\Component;

class CourseAction extends Component
{
    public $id;
    public $is_completed = false;
    public $is_stop = false;
    public $is_favorite = false;
    public $is_has_course = false;
    public $rating = 0;

    public function mount() {
        $this->check();
    }

    public function favorite() {
        $courseId = $this->id;
        $user = auth()->user()->courses();
        $value = $this->is_favorite ==  0 ? true : false;
        if(!$this->is_has_course) {
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
        $this->is_has_course = true;
    }

    public function myCourse() {
        if($this->is_completed) {
            return;
        }
        if(!$this->is_has_course) {
            auth()->user()->courses()->attach($this->id);
        } else if($this->is_has_course && $this->is_stop == true) {
            auth()->user()->courses()->updateExistingPivot($this->id, [
                'is_stop' => false
            ]);
        } else if($this->is_stop == false) {
            auth()->user()->courses()->updateExistingPivot($this->id, [
                'is_stop' => true
            ]);
        }
        $this->is_has_course = true;
    }


    public function check() {
        $is_has_course = auth()->user()->courses()->where('course_id', $this->id)->first();


        if($is_has_course) {
            $this->is_has_course = $is_has_course ? true : false;
            $this->is_completed =  $is_has_course->pivot->is_completed;
            $this->is_favorite =  $is_has_course->pivot->is_favorite;
            $this->is_stop =  $is_has_course->pivot->is_stop;
            $this->rating =  $is_has_course->pivot->value;
        }
    }
    public function render()
    {
        return view('livewire.course-action');
    }
}
