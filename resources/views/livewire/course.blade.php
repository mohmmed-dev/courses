<div class="card bg-base-100 shadow-sm">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <figure class="relative overflow-hidden aspect-video"> <!-- نسبة 16:9 -->
        <img class="w-full h-[calc(100%+40px)] object-cover -top-5"
            src="{{$course->thumbnail}}"
            alt="{{$course->slug}}" />
    </figure>
    <a href="{{route('course.show',$course->slug)}}" class=" card-body p-2">
        <h2 class="card-title">
            {{Str::limit($course->title,30)}}
        </h2>
        <a href="{{route('teacher.show',$course->teacher->slug)}}" class="badge badge-info">
            <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle><path d="m12,17v-5.5c0-.276-.224-.5-.5-.5h-1.5" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path><circle cx="12" cy="7.25" r="1.25" fill="currentColor" stroke-width="2"></circle></g></svg>
            {{$course->teacher->name}}
        </a>
        <div class=" flex justify-between mt-2 items-center">
            <div class="p-2 w-1/2 border-r-2">@livewire('ratings', ['str' => $course->rate()], key($course->slug))</div>
            <div class="p-2 w-1/2 text-center">{{$course->time}}</div>
        </div>
    </a>
</div>
