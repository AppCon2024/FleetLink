<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Main Address') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Please provide your home or permanent address where to contact you when needed. The provided address once entered and saved is no longer editable. If you wish to change it please contact your supervisor. ') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.addressUpdate') }}">
        @csrf
        @method('patch')
        <div class="grid gap-3 mb-2 mt-2 sm:grid-cols-2">
            <div class="col-sm-6 mb-2">
                <x-input-label for="region" :value="__('Region*')" />
                <select name="region" :value="old('region', $user->region)"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"
                    id="region"></select>
                <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                @error('region')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="col-sm-6 mb-3">
                <x-input-label for="province" :value="__('Province*')" />
                <select
                    name="province"class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"
                    id="province"></select>
                <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text"
                    required>
                    @error('province')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="col-sm-6 mb-3">
                <x-input-label for="city" :value="__('City*')" />
                <select name="city"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"
                    id="city"></select>
                <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                @error('city')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="col-sm-6 mb-3">
                <x-input-label for="barangay" :value="__('Barangay*')" />
                <select name="barangay"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"id="barangay"></select>
                @error('barangay')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <x-input-label for="street" :value="__('Street (Optional) *')" />
                <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street',$user->street)"
                    required autofocus autocomplete="street" id="street" />
                <x-input-error class="mt-2" :messages="$errors->get('street')" />
            </div>

            <div class="col-md-6 mb-3">
                <x-input-label for="zip_code" :value="__('Zip Code*')" />
                <x-text-input id="ste" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code',$user->zip_code)"
                    required autofocus autocomplete="zip_code" id="zip_code" />
                <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'address-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
