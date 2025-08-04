<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FilterPaths extends Component
{
    public User $user;
    public $type;
    public $value;
    public function mount($username) {
        $this->user = User::where('username', $username)->firstOrFail();
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
