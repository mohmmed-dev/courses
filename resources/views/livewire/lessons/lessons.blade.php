<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <ul class="list bg-base-100 rounded-box shadow-md h-96 overflow-y-auto">
        @forelse ($course->lessons as $lesson)
            @livewire('lessons.lesson', ['lesson' => $lesson], key($lesson->slug))
        @empty
        @endforelse
    </ul>
</div>
