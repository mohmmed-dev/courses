<div class="card bg-base-100 shadow-sm">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <figure>
        <img
        src="{{$course->path_image}}"
        alt="Shoes" />
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
