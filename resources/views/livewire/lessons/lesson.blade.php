<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <li class="list-row border-1-red-500 border-t-2  {{ $check->pivot->stop ?? false ? 'border-t-indigo-200' : ''}} hover:border-t-indigo-500 hover:mb-4">
        <div class="text-4xl font-thin opacity-30 tabular-nums ">
        {{$lesson->order}}
        </div>
        <div class="list-col-grow">
        <div>{{$lesson->title}}</div>
        <label class="swap">
        <div class="text-xs uppercase font-semibold opacity-60">24:44:00</div>
        </div>
        <div wire:click="view" class="btn btn-square btn-ghost">
            <div wire:show="show" class="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
            </svg>
            </div>
            <div wire:show="!show" class="swap-off">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg>
            </div>
        </div>
    </li>
</div>
