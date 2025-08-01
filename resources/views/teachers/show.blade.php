<x-app-layout>
    <div class="bg-base-100 ">
        <div class="mb-7 p-6 flex gap-x-4 items-center ">
            <div class="avatar">
                <div class="w-24 rounded-full">
                    <img src="{{$teacher->avatar}}" alt="{{$teacher->slug}}" />
                </div>
            </div>
            <div>
                <h2 class="text-3xl">{{$teacher->name}}</h2>
                <a href="{{$teacher->slug}}">{{$teacher->slug}}</a>
            </div>
        </div>
        <div role="tablist" class="tabs tabs-lift w-full">
            <div role="tab" class="tab tab-active">{{__('Courses')}} <span class="badge ">{{$teacher->courses_count}}</span> </div>
        </div>
    </div>
    <div class="grid grid-cols-12  gap-1 px-4">
            @include('helpers.courses',['courses' => $courses])
    </div>
</x-app-layout>
