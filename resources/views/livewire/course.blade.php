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
        <a href="{{route('teacher.show',$course->teacher->slug)}}" class="btn btn-ghost">
           {{-- <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle><path d="m12,17v-5.5c0-.276-.224-.5-.5-.5h-1.5" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path><circle cx="12" cy="7.25" r="1.25" fill="currentColor" stroke-width="2"></circle></g></svg>
           --}}
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
           <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            {{$course->teacher->name}}
        </a>
        <div class=" flex justify-between mt-2 items-center">
            <div class="p-2 w-1/2 border-r-2">@livewire('ratings', ['str' => $course->rate()], key($course->slug))</div>
            <div class="p-2 w-1/2 text-center">{{$course->time}}</div>
        </div>
    </a>
</div>
