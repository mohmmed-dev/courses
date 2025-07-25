<x-app-layout>
    <div class="bg-base-100 ">
        <div class="mb-7 p-6 flex gap-x-4 items-center ">
            <div class="avatar">
                <div class="w-24 rounded-full">
                    <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />
                </div>
            </div>
            <div>
                <h2 class="text-3xl">Card Title</h2>
                <h4>@jsjs</h4>
            </div>

        </div>
        <div role="tablist" class="tabs tabs-lift w-full">
            <a role="tab" class="tab tab-active">{{__('Courses')}}</a>
            <a role="tab" class="tab">{{__('Paths')}}</a>
            <a role="tab" class="tab">{{__('Type')}}</a>
        </div>
    </div>
</x-app-layout>
