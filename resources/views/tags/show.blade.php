<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        <div class="my-2 col-start-2 col-span-10">
            <h2 class="text-2xl">{{__("Result: ") . $title}}</h2>
        </div>
        <div class="my-2 col-start-2 col-span-10">
                @include('helpers.paths', ['paths' => $paths])
        </div>
            @include('helpers.courses', ['courses' => $courses])
    </div>
</x-app-layout>
