<div class="carousel w-full p-4 space-x-4 bg-gray-200 rounded-box shadow-lg">
    @forelse ($paths as $path)
    <div class="my-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-5 lg:col-span-3">
        <div class="carousel-item card w-96 bg-base-100 shadow-xl">
            <div class="rounded-md ">
                <a class="hero h-46 rounded-md " style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
                    <div class="hero-overlay rounded-md "></div>
                    <div class="hero-content text-neutral-content text-center">
                        <div class="max-w-md">
                            <h1 class="mb-5 text-2xl font-bold">{{$path->title}}</h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @empty
    @endforelse
</div>
