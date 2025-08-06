<?php

namespace App\Livewire;

use Livewire\Component;

class Progress extends Component
{
    public $completed;
    public $remaining;
    public $total;
    public $total_percentage;

    public function mount($progress) {
        $this->completed = $progress['completed'] ?? 0;
        $this->remaining = $progress['remaining'] ?? 0;
        $this->total = $progress['total'] ?? 0;
        $this->total_percentage = ($this->total > 0) ? ($this->completed / $this->total) * 100 : 0;
    }
    public function render()
    {
        return view('livewire.progress');
    }
}
