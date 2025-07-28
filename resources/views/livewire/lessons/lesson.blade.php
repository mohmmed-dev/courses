<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <li class="list-row">
    <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
    <div></div>
    <div class="list-col-grow">
      <div>{{$lesson->title}}</div>
      <div class="text-xs uppercase font-semibold opacity-60">24:44:00</div>
    </div>

    <a href="{{route('lesson.show' , $lesson->id)}}" class="btn btn-square btn-ghost">
      <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
    </a>

  </li>
</div>
