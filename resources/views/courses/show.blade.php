<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-6 rounded-md ">
            <div class="card bg-base-100 shadow-sm">
            <figure class="relative overflow-hidden aspect-video"> <!-- نسبة 16:9 -->
                <img class="w-full h-[calc(100%+40px)] object-cover -top-5"
                    src="https://i.ytimg.com/vi/XiRdPYcJOBQ/hqdefault.jpg"
                    alt="{{$course->slug}}" />
            </figure>
            <a href="{{route('course.show',$course->slug)}}" class="card-body p-2">
                <h2 class="card-title">
                    {{Str::limit($course->title,20)}}
                </h2>
                <p class="text-stone-200">{{Str::limit($course->description,30)}}</p>
                <div class="card-actions justify-end">
                    <div class="badge badge-outline">Fashion</div>
                    <div class="badge badge-outline">Products</div>
                </div>
            </a>
        </div>
            @auth
                @livewire("mark",["id"=>$course->id])
            @endauth
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-6 rounded-md">
            @livewire("lessons.lessons", ["course"=> $course])
        </div>
    </div>
</x-app-layout>
