<x-app-layout>
    <div class="carousel w-full p-4 space-x-4 bg-gray-200 rounded-box shadow-lg">
        @forelse ($categories as $category)
            <div class="my-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-5 lg:col-span-3">
                {{-- @livewire('course', ['course' => $course], key($course->id)) --}}
                 <div class="carousel-item card w-64 bg-base-100 shadow-xl">
                    <div class="card-body items-center text-center">
                        <h2 class="card-title text-lg font-semibold">{{$category->name}}</h2>
                    </div>
                </div>
            </div>

            @empty
        @endforelse
    </div>
    <div class="grid grid-cols-12  gap-1 px-4">
        @forelse ($courses as $course)
            <div class="my-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-5 lg:col-span-3">
                @livewire('course', ['course' => $course], key($course->id))
            </div>
            @empty
        @endforelse
    </div>
    <div class="p-3">
        {{ $courses->links() }}
    </div>
</x-app-layout>
