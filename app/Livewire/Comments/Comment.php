<?php

namespace App\Livewire\Comments;

use Livewire\Component;

class Comment extends Component
{
     public $comment;
    public $update = false;
    public $replays = false;
    public $video;
    public $bodyUpdate;
    public function showRepay() {
        if($this->replays) {
            $this->replays = false;
            return;
        }
        $this->replays = true;
        return;
    }
    public function render()
    {
        return view('livewire.comments.comment');
    }
}
