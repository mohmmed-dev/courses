<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
        <div class="card bg-base-100 shadow-sm  mb-2">
        @livewire('progress',['progress' => $progress])
        </div>
    <ul class="list bg-base-100 flex flex-col justify-between rounded-box shadow-md max-h-screen overflow-y-auto">
        @forelse ($lessons as $lesson)
            @livewire('lessons.lesson', ['lesson' => $lesson], key($lesson->slug))
        @empty
        @endforelse
        {{ $lessons->links() }}
    </ul>
</div>
