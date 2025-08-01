<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FilterCourses extends Component
{
   // public $username;
    public User $user;
    public $type;
    public function mount($username) {
        $this->user = User::where('username', $username)->firstOrFail();
        $this->filter("is_favorite");
    }
    public function filter($type) {
        $this->type = $type;
    }
    public function getCoursesProperty() {
        return $this->user->courses()->wherePivot($this->type, 1)->paginate(15);
    }
    public function render()
    {
        return view('livewire.filter-courses');
    }
}
