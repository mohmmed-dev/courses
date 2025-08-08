<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box  border p-4">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </fieldset>

            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box  border p-4">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </fieldset>

            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box  border p-4">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </fieldset>
        </div>
    </div>
</x-app-layout>
