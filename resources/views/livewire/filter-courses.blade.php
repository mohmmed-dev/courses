<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div role="tablist" class="tabs tabs-box mt-3 w-fit mx-auto">
        <a role="tab" wire:click="filter('is_favorite')" class="tab {{$type ==  'is_favorite' ? 'tab-active' : '' }} ">{{__("Favorite")}}</a>
        <a role="tab" wire:click="filter('is_completed',0)" class="tab {{($type == 'is_completed' && $value == 0 ) ? 'tab-active' : '' }}">{{__('Completed')}}</a>
        <a role="tab" wire:click="filter('is_completed')" class="tab {{($type == 'is_completed' && $value == 1 ) ? 'tab-active' : '' }}">{{__('Completed')}}</a>
    </div>
    <div class="w-fit mx-auto my-3" >
        <span class="loading loading-dots loading-lg" wire:loading wire:target="filter"></span>
    </div>
    <div class="grid grid-cols-12  gap-1 px-4">
    @forelse ($this->courses as $course)
        <div class="my-2 col-start-2 col-span-10 md:col-span-6 lg:col-span-6">
            <div class="card bg-base-100 shadow-sm sm:flex-row">
                {{-- If your happiness depends on money, you will never be happy with yourself. --}}
                <figure class="relative overflow-hidden aspect-video sm:w-1/3"> <!-- نسبة 16:9 -->
                    <img class="w-full h-[calc(100%+40px)] object-cover -top-5"
                        src="{{$course->thumbnail}}"
                        alt="{{$course->slug}}" />
                </figure>
                <a href="{{route('course.show',$course->slug)}}" class=" card-body p-2 sm:w-2/3 justify-between">
                    <h2 class="card-title  p-2">
                        {{Str::limit($course->title,20)}}
                    </h2>
                    <div class="card-body p-2 gap-2">
                        <progress class="progress" value="90" max="100"></progress>
                        <div class="flex  items-center justify-between"><strong>4/5</strong> <strong>100%/90</strong> </div>
                    </div>
                </a>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    <div class="p-3">
        {{ $this->courses->links() }}
    </div>
    </div>
</div>
