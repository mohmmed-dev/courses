<div class="carousel w-full p-4 space-x-4 bg-gray-200 rounded-box shadow-lg">
        @forelse ($categories as $category)
            <div class="my-2 mx-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-5 lg:col-span-3">
            <a href="{{route('category.show',$category->slug)}}" class="carousel-item card w-64 bg-base-100 shadow-xl">
            <div class="card-body items-center text-center">
            <h2 class="card-title text-lg font-semibold">{{$category->name}}</h2>
        </div>
        </a>
        </div>
            @empty
        @endforelse
    </div>
