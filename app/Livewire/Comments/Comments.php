<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Lesson;
use Livewire\Attributes\On;
class Comments extends Component
{
   public Lesson $lesson;
   public $comments;
    #[On('comment')]
    public function comments()
    {
        $this->comments =  $this->lesson->comments()
            ->with('user')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        $this->comments();
        return view('livewire.comments.comments');
    }
}
