<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FilterCourses extends Component
{
    public User $user;
    public $type;
    public $value;
    public $completed_count;
    public $InCompleted_count;
    public $favorite_count;
    public $stopped_count;
    public function mount($username) {
        $this->user = User::where('username', $username)->withCount([
            'courses as courses_completed_count' => function($query) {
            $query->where("is_completed",true);},
            'courses as courses_InCompleted_count' => function($query) {
            $query->where("is_completed",false)->where("is_stop",false);
            },
            'courses as courses_favorite_count' => function($query) {
            $query->where("is_favorite",true);},
            'courses as courses_stop_count' => function($query) {
            $query->where("is_stop",true);} ,
        ])->firstOrFail();

        $this->completed_count = $this->user->courses_completed_count;
        $this->InCompleted_count = $this->user->courses_InCompleted_count;
        $this->favorite_count = $this->user->courses_favorite_count;
        $this->stopped_count = $this->user->courses_stop_count;

        $this->filter('is_completed',0);
    }

    public function filter($type , $value = 1) {
        $this->value = $value;
        $this->type = $type;
    }

    public function getCoursesProperty() {
        if($this->type == 'is_completed' && $this->value == 0) {
            $courses = $this->user->courses()->wherePivot($this->type, $this->value)->wherePivot('is_stop',0)->withCount(['lessons',"lessons as completed_lessons_count" => function($query) {
            $query->whereHas('users', function ($q) {
            $q->where('user_id', $this->user->id)->where("is_completed",true);
            });
            },
            ])->paginate(15);
        return $courses;
        }
        $courses = $this->user->courses()->wherePivot($this->type, $this->value)->withCount(['lessons',"lessons as completed_lessons_count" => function($query) {
            $query->whereHas('users', function ($q) {
            $q->where('user_id', $this->user->id)->where("is_completed",true);
            });
        },
            ])->paginate(15);
        return $courses;
    }

    public function progress($lessons_count,$completed_count) : Array {

        return [
            'completed' => $completed_count,
            'remaining' => $lessons_count - $completed_count,
            'total' => $lessons_count
        ];
    }
    public function render()
    {
        return view('livewire.filter-courses');
    }
}
