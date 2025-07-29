<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 lg:col-span-6 rounded-md ">
            @livewire("player", ["course" => $course,"lesson" => $lesson])
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-6 rounded-md">
            @livewire('lessons.lessons', ['course' => $course])
        </div>
        <div class="my-2 col-start-2 w-full h-full col-span-10 sm:col-start-0 sm:col-span-12 md:col-span-6 lg:col-span-8">
            @livewire('comments.comments',["lesson" => $lesson])
        </div>
    </div>
</x-app-layout>
