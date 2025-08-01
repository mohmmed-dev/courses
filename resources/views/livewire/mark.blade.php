<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <label class="swap swap-flip "  >
        <!-- this hidden checkbox controls the state -->
        <input type="checkbox"  @checked($this->is_completed) wire:click="myCourse" class="hidden" />
        <div class="swap-on">{{__("add Mark")}}</div>
        <div class="swap-off">{{__("remove mark")}}</div>
    </label>
    <label class="swap swap-flip"  >
        <!-- this hidden checkbox controls the state -->
        <input type="checkbox"  @checked($this->is_favorite) wire:click="favorite" class="hidden" />
        <div class="swap-on">{{__("add courses")}}</div>
        <div class="swap-off">{{__("remove Mark")}}</div>
    </label>
    {{-- <div>{{$this->is_completed == 0 ? 'no': 'yes'}}</div>
    <button class="btn btn-primary" wire:click="myMark">Primary</button> --}}
    {{-- <button class="btn btn-neutral" wire:click="myCourse">Neutral</button> --}}
    {{-- <div>{{$this->is_favorite == 0 ? 'no': 'yes'}}</div>
    <button class="btn btn-primary" wire:click="myMark">Primary</button> --}}

</div>
