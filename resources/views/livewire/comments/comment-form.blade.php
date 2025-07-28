<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class=" bg-white shadow-md rounded-md my-4 px-2 py-4">

    @auth
        @session('error')
            <x-alert title="{{__('error')}}" description="{{__(session('error'))}}" class="m-2 bg-red-500 shadow-none border-none" dismissible />
        @endsession
    <form class="flex items-center gap-x-1" wire:submit='save' action="#form-comment">
            <div class="w-3/4">
                <input type="text" wire:model="body" name="body" id="body" value="{{old('title')}}" required class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="{{__("Desecration")}}">
                @error('body')
                    <p class="text-xl text-red-500">{{$message}}</p>
                @enderror
            </div>
            <x-button label="{{__('Save')}}" class="btn-primary" type="submit" spinner="save" />
        </form>
        @else
            <a href="{{route('login')}}" class=" border-b-2 pb-2">{{__("Log In To Add A Comment")}}</a>
        @endauth
    </div>
</div>
