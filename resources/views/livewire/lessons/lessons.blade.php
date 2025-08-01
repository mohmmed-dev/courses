<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
        <div class="card bg-base-100 shadow-sm mt-2 mb-2">
            <div class="card-body p-2 gap-2 ">
            <div
                class="radial-progress bg-primary text-primary-content border-primary border-2 "
                style="--value:30;" aria-valuenow="30" role="progressbar">
                30%
                </div>
            </div>
        </div>
    <ul class="list bg-base-100 flex flex-col justify-between rounded-box shadow-md max-h-screen overflow-y-auto">
        @forelse ($lessons as $lesson)
            @livewire('lessons.lesson', ['lesson' => $lesson], key($lesson->slug))
        @empty
        @endforelse
        {{ $lessons->links() }}
    </ul>
</div>
