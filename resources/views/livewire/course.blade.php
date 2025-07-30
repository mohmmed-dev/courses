<div class="card bg-base-100 shadow-sm">
    {{-- If your happiness depends on money, you will never be happy with yourself.
    <figure>
        <img class=""
        src="{{$course->thumbnail}}"
        alt="{{$corse->slug}}" />
    </figure>
    <figure class="max-w-[250]  max-h-[230] relative">
        nn
   <div class="relative bg-red-500 w-full h-[230px] overflow-hidden">
        <img class="absolute w-full h-[calc(100%+50px)] top-[-25px] object-cover"
             src="https://i.ytimg.com/vi/XiRdPYcJOBQ/hqdefault.jpg"
             alt="{{$course->slug}}" />
    </div>
    </figure> --}}
    <figure class="relative overflow-hidden aspect-video"> <!-- نسبة 16:9 -->
        <img class="w-full h-[calc(100%+40px)] object-cover -top-5"
            src="https://i.ytimg.com/vi/XiRdPYcJOBQ/hqdefault.jpg"
            alt="{{$course->slug}}" />
    </figure>
    <a href="{{route('course.show',$course->slug)}}" class="card-body p-2">
        <h2 class="card-title">
            {{Str::limit($course->title,20)}}
        </h2>
        <p class=" text-stone-200">{{Str::limit($course->description,30)}}</p>
        <div class="card-actions justify-end">
        <div class="badge badge-outline">Fashion</div>
        <div class="badge badge-outline">Products</div>
        </div>
    </a>
</div>
