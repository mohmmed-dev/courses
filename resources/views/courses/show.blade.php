<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        {{-- START CARD --}}
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-6 rounded-md ">
            <div class="card bg-base-100 shadow-sm mb-2">
                <a href="{{route('teacher.show',$course->teacher->slug)}}" class="card-body p-2 flex flex-row items-center gap-2">
                    <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img src="{{$course->teacher->avatar}}" />
                    </div>
                    </div>
                    <div><strong>{{$course->teacher->username}}</strong>
                    <strong>{{$course->teacher->name}}</strong></div>
                </a>
            </div>
            <div class="card bg-base-100 shadow-sm">
            <figure class="relative overflow-hidden aspect-video"> <!-- نسبة 16:9 -->
                <img class="w-full h-[calc(100%+40px)] object-cover -top-5"
                    src="https://i.ytimg.com/vi/XiRdPYcJOBQ/hqdefault.jpg"
                    alt="{{$course->slug}}" />
            </figure>
            <div class="card-body p-2">
                <h2 class="card-title text-4xl">
                    {{$course->title}}
                </h2>
                <h3 class="text-1xl">{{__("Description")}}</h3>
                <p class="text-stone-500">
                    {{$course->description}}
                </p>
                <div class="flex flex-wrap gap-2">
                    <div class="badge badge-info badge-lg">
                    <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle>
                            <path d="m12,17v-5.5c0-.276-.224-.5-.5-.5h-1.5" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path>
                            <circle cx="12" cy="7.25" r="1.25" fill="currentColor" stroke-width="2"></circle>
                        </g>
                    </svg>
                    Info
                    </div>
                    <div class="badge badge-success badge-lg">
                        <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt">
                                <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle>
                                <polyline points="7 13 10 16 17 8" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></polyline>
                            </g>
                        </svg>
                        Success
                    </div>
                    <div class="badge badge-warning badge-lg">
                        <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <g fill="currentColor">
                                <path d="M7.638,3.495L2.213,12.891c-.605,1.048,.151,2.359,1.362,2.359H14.425c1.211,0,1.967-1.31,1.362-2.359L10.362,3.495c-.605-1.048-2.119-1.048-2.724,0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                <line x1="9" y1="6.5" x2="9" y2="10" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                                <path d="M9,13.569c-.552,0-1-.449-1-1s.448-1,1-1,1,.449,1,1-.448,1-1,1Z" fill="currentColor" data-stroke="none" stroke="none"></path>
                            </g>
                        </svg>
                        Warning
                    </div>
                    <div class="badge badge-error badge-lg">
                        <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="currentColor">
                                <rect x="1.972" y="11" width="20.056" height="2" transform="translate(-4.971 12) rotate(-45)" fill="currentColor" stroke-width="0"></rect>
                                <path d="m12,23c-6.065,0-11-4.935-11-11S5.935,1,12,1s11,4.935,11,11-4.935,11-11,11Zm0-20C7.038,3,3,7.037,3,12s4.038,9,9,9,9-4.037,9-9S16.962,3,12,3Z" stroke-width="0" fill="currentColor"></path>
                            </g>
                        </svg>
                        Error
                    </div>
                </div>
                    <div class="py-2">
                        @livewire('ratings', ['str' => $course->rate()], key($course->slug))
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-sm mt-2 mb-2">
                <div class="card-body p-2 gap-2">
                    @auth
                        @livewire('mark', ['id' => $course->id])
                    @else
                    @endauth
                    @php
                        $progress = auth()->check() ? auth()->user()->getCourseProgress($course) : [];
                        $completed = $progress['completed'] ?? 0;
                        $remaining = $progress['remaining'] ?? 0;
                        $total = $progress['total'] ?? 0;
                        $ch = ($total > 0) ? ($completed / $total) * 100 : 0;
                    @endphp
                    <progress class="progress" value="{{$ch}}" max="100"></progress>
                    <div class="flex  items-center justify-between"><strong>{{$total}}/{{$completed}}</strong> <strong>100%/{{$ch}}%</strong> </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-sm mt-2 mb-2">
                <div class="card-body p-2 gap-2">
                <div class="card-actions justify-end">
                    @forelse ($course->tags as $tag)
                    <a href="{{route('tag.show',$tag->slug)}}" class="badge badge-outline hover:badge-info">{{$tag->name}}</a>
                    @empty
                    @endforelse
                </div>
                </div>
            </div>
        </div>
        {{-- END CARD --}}
        {{-- START LESSON --}}
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-6 rounded-md">
            @livewire("lessons.lessons", ["course"=> $course])
        </div>
        {{-- END LESSON --}}
    </div>
</x-app-layout>


