<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div>{{$this->courseCheck == 0 ? 'no': 'yes'}}</div>
    <button class="btn btn-neutral" wire:click="myCourse">Neutral</button>
    <div>{{$this->markCheck == 0 ? 'no': 'yes'}}</div>
    <button class="btn btn-primary" wire:click="myMark">Primary</button>
</div>
