<?php

namespace App\Livewire;

use Livewire\Component;

class PathAction extends Component
{
    public $pathId;
    public $is_completed = false;
    public $isJoin = false;

    public function mount($id, $is_completed = false, $join = false) {
        $this->is_completed = $is_completed;
        $this->pathId = $id;
        $this->isJoin = $join;
    }

    public function joanToPath() {
        if(!$this->is_completed && auth()->check()) {
            auth()->user()->paths()->toggle($this->pathId);
        }
        return;

    }

    public function render()
    {
        return view('livewire.path-action');
    }
}
