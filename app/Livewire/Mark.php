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
    
    public function mark() {
        dd('ff');
        $user = auth()->user()->courses();
        $courseId = $this->id;
        if(!$this->markCheck && !$this->courseCheck) {
            $user->toggle([$this->id => [
                'nomination' => 1,
            ]]);
        } else {
            $user->updateExistingPivot($courseId, [
            'nomination' => $this->markCheck ==  0 ? 1 : 0
            ]);
        }
        $this->check();
    }

    public function mycoures() {
        $courseId = $this->id;
        $user = auth()->user()->courses();

        if(!$this->markCheck && !$this->courseCheck) {
            $user->toggle([$this->id => [
                'is_favorite' => 1,
            ]]);
        } else {
        $user->updateExistingPivot($courseId, [
            'is_favorite' => $this->courseCheck ==  0 ? 1: 0
            ]);
        }
        $this->check();
    }

    public function check() {
        // ابحث عن الكورس بهذا الـ id
        $mark = auth()->user()->courses()->where('course_id', $this->id)->first();
        if($mark) {
            // لا تغير قيمة $this->id حتى تبقى هي course_id
            $this->courseCheck = (bool) $mark->pivot->nomination;
            $this->markCheck = (bool) $mark->pivot->is_favorite;
        }
        // dump($this->markCheck . $this->courseCheck); // يمكن التعليق أو الإزالة
    }
    public function render()
    {
        return view('livewire.mark');
    }
}
