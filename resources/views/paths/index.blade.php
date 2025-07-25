<x-app-layout>
    <div class="grid grid-cols-12  gap-1 px-4">
        @forelse ($paths as $path)
            <div class="my-2 col-start-2 col-span-10 sm:col-start-0 sm:col-span-6 md:col-span-5 lg:col-span-3">
                @livewire('path', ['path' => $path], key($path->id))
            </div>
            @empty
        @endforelse
    </div>
    <div class="p-3">
        {{ $paths->links() }}
    </div>
</x-app-layout>
