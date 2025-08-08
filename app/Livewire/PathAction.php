<?php

namespace App\Livewire;

use Livewire\Component;

class PathAction extends Component
{
    public $id;
    public $is_completed = 0;
    public $is_join = 0;
    public $rating = 0;

    public function mount() {
        $this->check();
    }
    

    public function joanToPath() {
        if(!$this->is_completed && auth()->check()) {
            auth()->user()->paths()->toggle($this->id);
        }
        return;
    }

    public function check() {
        $is_has_path = auth()->user()->paths()->where('path_id', $this->id)->first();
        if($is_has_path) {
            $this->is_completed =  $is_has_path->pivot->is_completed;
            $this->is_join =  $is_has_path->pivot->is_favorite;
            $this->rating =  $is_has_path->pivot->value;
        }
    }

    public function render()
    {
        return view('livewire.path-action');
    }
}
