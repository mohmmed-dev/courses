<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Path;
use Livewire\Component;

class Review extends Component
{
    public ?Path $path;
    public ?Course $course;
    public $rating = 1;
    public $review;

    public function mount($type = null,$id = null) {
        if(empty($type) || empty($id)) {
            return;
        }

        if($type == 'path') {
            $this->path = Path::findOrFail($id);
        } else if($type == 'course') {
            $this->course = Course::findOrFail($id);
        }
    }

    public function save() {
        if(!auth()->check() ) {
            return;
        }
        if(!empty($this->path)) {
            $this->path->users()->updateExistingPivot(auth()->id() ,[
                'value' => $this->rating,
                'review' => $this->review,
            ]);
            return redirect()->route('path.show',$this->path->slug);
        } elseif (!empty($this->course)) {
        $this->course->users()->updateExistingPivot(auth()->id() ,[
                'value' => $this->rating,
                'review' => $this->review,
            ]);
            return  redirect()->route('course.show',$this->course->slug);
        } else {
            return;
        }
    }
    public function render()
    {
        return view('livewire.review');
    }
}
