<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Comment as ModelsComment;
use Livewire\Attributes\On;

class Comment extends Component
{
    public ModelsComment $comment;
    public $lesson;
    public $open = false;
    #[On('replay')]
    public function  getCommentsProperty() {
        return $this->comment->replies;
    }
    public function render()
    {
        return view('livewire.comments.comment');
    }
}
