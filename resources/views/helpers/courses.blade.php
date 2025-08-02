    @forelse ($courses as $course)
        <div class="my-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-4 lg:col-span-3">
            @livewire('course', ['course' => $course], key($course->id))
        </div>
        @empty
        @endforelse
    </div>
    <div class="p-3">
        {{ $courses->links() }}
    </div>

