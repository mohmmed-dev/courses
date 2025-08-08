<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div role="tablist" class="tabs tabs-box mt-3 w-fit mx-auto">
        <a role="tab" wire:click="filter('is_completed',0)" class="tab {{($type == 'is_completed' && $value == 0 ) ? 'tab-active' : '' }}">{{__('In Completed')}} <div class="badge badge-soft  badge-warning mx-1">{{$InCompleted_count}}</div></a>
        <a role="tab" wire:click="filter('is_completed',1)" class="tab {{($type == 'is_completed' && $value == 1 ) ? 'tab-active' : '' }}">{{__('Completed')}} <div class="badge badge-soft badge-success mx-1">{{$completed_count}}</div></a>
    </div>
    <div class="w-fit mx-auto my-3" >
        <span class="loading loading-dots loading-lg" wire:loading wire:target="filter"></span>
    </div>
    <div class="grid grid-cols-12 gap-1 px-4">
    @forelse ($this->paths as $path)
        <div class="my-2 col-start-2 col-span-10 md:col-span-6 lg:col-span-4">
            <div class="card bg-base-100 shadow-sm sm:flex-row">
                {{-- If your happiness depends on money, you will never be happy with yourself. --}}
            <div class="rounded-md w-full ">
                <a href="{{route('path.show',$path->slug)}}" class="hero h-52 rounded-md w-full " style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
                    <div class="hero-overlay rounded-md "></div>
                    <div class="hero-content text-neutral-content text-center">
                        <div class="max-w-md">
                            <h1 class="mb-5 text-2xl font-bold">{{$path->title}}</h1>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    <div class="p-3">
        {{ $this->paths->links() }}
    </div>
    </div>
</div>
