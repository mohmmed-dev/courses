<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use Livewire\Attributes\On;
//use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class Box extends Component
{
     public $comment;
    public $update = false;
    public $type;
    public $bodyUpdate;
       public function updateComment() {
        //Gate::authorize('update_comment',$this->comment);
        if($this->update) {
            $this->update = false;
            $this->dispatch('update');
            return;
        }
        $this->bodyUpdate = $this->comment->body;
        $this->update = true;
        $this->dispatch('update');
        return;
    }

        public function update_comment($id) {
         //   Gate::authorize('update_comment',$this->comment);
            $comment = Comment::findOrFail($id);
            $comment->body = $this->bodyUpdate;
            $comment->save();
            $this->updateComment();
        }

    public function delete_comment($id) {
       // Gate::authorize('update_comment',$this->comment);
        $comment = Comment::findOrFail($id);
        $comment->delete();
        $this->dispatch($this->type);
    }
    #[On('update')]
    public function render()
    {
        return view('livewire.comments.box');
    }
}
