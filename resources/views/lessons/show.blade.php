<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        <div class="card bg-base-100 shadow-sm mt-2 mb-2 my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-8 rounded-md  flex-row items-center gap-x-1 px-2 justify-between">
            <div class="flex items-center gap-x-1 ">
                <div class="text-4xl font-thin opacity-30 tabular-numer  ">
                {{$lesson->order}}
                </div>
                    <div class="list-col-grow">
                        <div>{{$lesson->title}}</div>
                        <div class="text-xs uppercase font-semibold opacity-60 flex gap-x-1 flex-wrap ">
                            <div class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{$time}}
                            </div>
                            <div class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            {{$lesson->views}}
                            </div>
                            <a href="{{route('course.show', $lesson->course->slug)}}" class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            {{$lesson->course->title}}
                            </a>
                        </div>
                </div>
            </div>
            <div>
                @livewire('lesson-check', ['is_completed' => false,'id' =>  $lesson->id])
            </div>
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-8 rounded-md ">
            @livewire("player", ["course" => $course,"lesson" => $lesson])
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-4 rounded-md">
            @livewire('lessons.lessons', ['course' => $course])
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-10">
            @livewire('comments.comments',["lesson" => $lesson])
        </div>
    </div>
</x-app-layout>
