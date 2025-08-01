<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class Ratings extends Component
{
    public $str;
    public function mount($str)
    {
        $this->str = $str;
    }
    public function render()
    {
        return view('livewire.ratings');
    }
}
