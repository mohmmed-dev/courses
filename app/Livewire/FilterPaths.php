<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FilterPaths extends Component
{
    public User $user;
    public $type;
    public $value;
    public $completed_count;
    public $InCompleted_count;
    public function mount($username) {
        $this->user = User::where('username', $username)->withCount([
            'paths as paths_completed_count' => function($query) {
            $query->where("is_completed",true);},
            'paths as paths_InCompleted_count' => function($query) {
            $query->where("is_completed",false);
            }])->firstOrFail();
        $this->completed_count = $this->user->paths_completed_count;
        $this->InCompleted_count = $this->user->paths_InCompleted_count;
        $this->filter('is_completed',0);
    }
    public function filter($type , $value = 0) {
        $this->value = $value;
        $this->type = $type;
    }
    public function getPathsProperty() {
        return $this->user->paths()->wherePivot($this->type, $this->value)->paginate(15);
    }
    public function render()
    {
        return view('livewire.filter-paths');
    }
}
