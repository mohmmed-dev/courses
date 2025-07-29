<?php

namespace App\Livewire\Comments;

use Livewire\Component;

class CommentForm extends Component
{
    public $lesson;
    public $comment;
    public $body = '';
    public $type;
    function save() {
        //dd($this->body);
        $this->lesson->comments()->create([
            'body' => $this->body,
            'user_id' => auth()->id(),
            'parent_id' => $this->comment
        ]);
        $this->body = '';
        // $notification = new Notification();
        // $notification->user_id = $this->video->user_id;
        // $notification->notification = $this->video->title;
        // $notification->success = 2;
        // $notification->save();
        // broadcast(new SendComment($this->video->title , $this->video->user_id));
        // $alert = Alert::where('user_id',$this->video->user_id)->first();
        // $alert->alerts++;
        // $alert->save();
        // $this->dispatch('alert');
        $this->dispatch($this->type);
    }
    public function render()
    {
        return view('livewire.comments.comment-form');
    }
}
