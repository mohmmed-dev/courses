<?php

namespace App\Livewire\Comments;

use Livewire\Component;

class Comments extends Component
{
   public $video;
    // public $comments;
    #[On('comment')]
    public function render()
    {
        $comments = $this->video->getVideoComments();
        return view('livewire.comments.comments');
    }
}
