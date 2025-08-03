<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FilterCourses extends Component
{
   // public $username;
    public User $user;
    public $type;
    public $value;
    public function mount($username) {
        $this->user = User::where('username', $username)->firstOrFail();
        $this->filter('is_completed',0);
    }
    public function filter($type , $value = 1) {
        $this->value = $value;
        $this->type = $type;
    }
    public function getCoursesProperty() {
        return $this->user->courses()->wherePivot($this->type, $this->value)->paginate(15);
    }
    public function render()
    {
        return view('livewire.filter-courses');
    }
}
