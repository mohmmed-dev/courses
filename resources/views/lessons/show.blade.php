<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-6 rounded-md ">
            <img
                src="{{ $course->thumbnail }}"
                class=" w-full rounded-top"
                alt="{{ $course->slug }}"
            />
            <div>
                <h1 class="text-2xl font-bold text-center">{{ $course->title }}</h1>
                <p class="text-center text-gray-200">{{ $course->description }}</p>
            </div>
            <div>
                <p class="text-center text-gray-400">
                    {{ $course->lessons->count() }}
                </p>
            </div>
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-6 rounded-md">
            {{-- @livewire('lessons.lessons', ['course' => $course], key($course->slug)) --}}
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-8 bg-slate-500">
            @livewire('comments.box', ['user' => $user], key($user->id))
        </div>
    </div>
</x-app-layout>
