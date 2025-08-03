<x-app-layout>
    <div class="bg-base-100 ">
        <div class="mb-7 p-6 flex gap-x-4 items-center ">
            <div class="avatar">
                <div class="w-24 rounded-full">
                    <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />
                </div>
            </div>
            <div>
                <h2 class="text-3xl">{{$user->name}}</h2>
                <a href="{{route('profile',$user->username)}}" >{{'@'.$user->username}}</a>
            </div>
        </div>
        <div role="tablist" class="tabs tabs-lift w-full">
            <a role="tab" href="{{route('profile',$user->username)}}" class="tab {{request()->routeIs('profile') ? "tab-active" : ''}}">{{__('Courses')}}</a>
            <a role="tab" href="{{route('profile.paths',$user->username)}}" class="tab {{request()->routeIs('profile.paths') ? "tab-active" : ''}}">{{__('Paths')}}</a>
            {{-- <a role="tab" href="{{route('profile.courses',$user->username)}}" class="tab {{request()->routeIs('profile.courses') ? "tab-active" : ''}}">{{__('Courses')}}</a> --}}
        </div>
    </div>
    @if(request()->routeIs('profile.paths'))
        @livewire("filter-paths" , ["username" => $user->username])
    @else
        @livewire("filter-courses" , ["username" => $user->username])
    @endif
</x-app-layout>
