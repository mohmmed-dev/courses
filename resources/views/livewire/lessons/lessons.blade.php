<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
        <div class="card bg-base-100 shadow-sm  mb-2">
        {{-- @php
            $progress = auth()->check() ? auth()->user()->getCourseProgress($course) : [];
            $completed = $progress['completed'] ?? 0;
            $remaining = $progress['remaining'] ?? 0;
            $total = $progress['total'] ?? 0;
            $ch = ($total > 0) ? ($completed / $total) * 100 : 0;
        @endphp --}}
            <div class="card-body p-2 gap-2 ">
            {{-- <div class="flex  items-center justify-between"><strong>{{$total}}/{{$completed }}</strong> <strong>100%/{{$ch ?? 0}}%</strong> </div>
            <progress class="progress" value="{{$ch}}" max="100"></progress> --}}
            </div>
        </div>
    <ul class="list bg-base-100 flex flex-col justify-between rounded-box shadow-md max-h-screen overflow-y-auto">
        @forelse ($lessons as $lesson)
            @dump($lesson->is_completed)
            @livewire('lessons.lesson', ['lesson' => $lesson], key($lesson->slug))
        @empty
        @endforelse
        {{ $lessons->links() }}
    </ul>
</div>
