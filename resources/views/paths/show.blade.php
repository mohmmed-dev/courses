<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        {{-- START Info --}}
        <div class="my-2 col-start-2 w-full h-full col-span-10 rounded-md ">
            <div class="card bg-base-100 shadow-sm md:flex-row">
                <figure class="relative overflow-hidden aspect-video  md:w-1/3">
                    <!-- نسبة 16:9 -->
                    <img class="w-full h-[calc(100%+40px)] object-cover -top-5" src="https://i.ytimg.com/vi/XiRdPYcJOBQ/hqdefault.jpg" alt="{{$path->slug}}" />
                </figure>
                <div class="card-body p-2 md:w-2/3">
                    <h2 class="card-title text-2xl md:text-4xl">
                        {{$path->title}}
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        <div class="badge badge-info badge-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                         {{$totalTime}}
                        </div>
                        <div class="badge badge-warning badge-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                             {{$lessons_count}}
                        </div>
                        <div class="badge badge-info badge-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                             {{$path->users_count}}
                        </div>
                        <div class="badge badge-warning badge-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                            </svg>
                           {{__($path->courses_count)}}
                        </div>
                    </div>
                    @auth
                        @livewire('path-action', ['id'=> $path->id ,'is_completed' => false , 'join' => false ] , key($path->id))
                    @endauth
                    <div class="card-body p-2 gap-2">
                        <div class="card-actions justify-end">
                            @forelse ($path->tags as $tag)
                            <a href="{{route('tag.show',$tag->slug)}}" class="badge badge-outline hover:badge-info">{{$tag->name}}</a>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm mt-2 mb-2 col-start-2 w-full h-full col-span-10 rounded-md">
            <div class="card-body p-2 gap-2 ">
                <div class="flex  items-center justify-between"><strong>{{$total ?? 0}}/{{$completed ?? 0 }}</strong> <strong>100%/{{$ch ?? 0}}%</strong> </div>
                <progress class="progress" value="{{$ch ?? 0}}" max="100"></progress>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm mt-2 mb-2 col-start-2 w-full h-full col-span-10 rounded-md">
                <div class="card-body p-2 gap-2">
                    <h3 class="text-2xl">{{__("Description")}}</h3>
                    <p class="text-stone-500">
                        {{$path->desorption}}
                        {!! str($path->desorption)->sanitizeHtml() !!}
                    </p>
                </div>
            </div>
        {{-- END Info --}}
        @forelse ($path->courses as $course)
                <div class="my-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-4 lg:col-span-3">
                    <div class="my-3 w-fit mx-auto">
                        <label class="swap swap-flip "  >
                    <!-- this hidden checkbox controls the state -->
                        <input type="checkbox" @disabled(true)  @checked($course->completed_by_users_exists)  class="hidden" />
                        <div class="swap-on btn btn-circle btn-success ">
                            {{$course->pivot->order}}
                        </div>
                        <div class="swap-off btn btn-circle btn-soft btn-success ">
                            {{$course->pivot->order}}
                        </div>
            </label>
            </div>
            @livewire('course', ['course' => $course], key($course->id))
        </div>
        @empty
        @endforelse
    </div>
    </div>
</x-app-layout>


