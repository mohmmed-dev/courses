<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class player extends Component
{
    /**
     * Create a new component instance.
     */
    public $videoId;

    public function __construct($videoId = null) // Make it optional
    {
        $this->videoId = $videoId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.player');
    }
}
