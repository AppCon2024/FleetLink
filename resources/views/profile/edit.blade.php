<x-app-layout>

    <div class="">

        <div class="sm:max-w-full max-w-xs mx-auto px-3 space-y-2 flex ">
            @include('includes.supv-sidebar.profile')
            <div class="grid gap-4 mb-4 mt-4 sm:grid-cols-2 ml-3">

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-2xl rounded-xl">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-2xl rounded-2xl">
                    <div class="max-w-full">
                        @include('profile.partials.update-address-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-2xl rounded-2xl">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-2xl rounded-2xl">
                    <div class="max-w-full">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
