<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-8 bg-red-500">
            @livewire('player', ['lesson' => $lesson], key($lesson->slug))
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-4 rounded-md">
            <ul class="list bg-base-100 rounded-box shadow-md">
                @forelse ($lessons as $lesson)
                    @livewire('lesson', ['lesson' => $lesson], key($lesson->slug))
                @empty
                @endforelse
            </ul>
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-8 bg-slate-500">
        </div>
    </div>
</x-app-layout>
