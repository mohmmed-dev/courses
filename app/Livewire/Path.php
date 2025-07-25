<?php

namespace App\Livewire;

use App\Models\Path as ModelsPath;
use Livewire\Component;

class Path extends Component
{
    public ModelsPath $path;
    public function render()
    {
        return view('livewire.path');
    }
}
