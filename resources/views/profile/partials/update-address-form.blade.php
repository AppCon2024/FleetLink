<section class="space-y-6">
    <header>
        <h2 class="flex flex-row items-center text-lg font-bold text-gray-900 dark:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
              </svg>

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

            @if (Auth::check() && Auth::user()->region_text)

                <div class="col-md-6 mb-3">
                    <x-input-label for="region" :value="__('Region *')" />
                    <x-text-input id="region_text" class="block mt-1 w-full bg-gray-100" type="text" name="region_text" :value="old('region_text', $user->region_text)"
                        required autofocus autocomplete="region_text" id="region_text" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('region_text')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="province" :value="__('Province *')" />
                    <x-text-input id="province_text" class="block mt-1 w-full bg-gray-100" type="text" name="province_text" :value="old('province_text', $user->province_text)"
                        required autofocus autocomplete="province_text" id="province_text" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('province_text')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="city" :value="__('City *')" />
                    <x-text-input id="city_text" class="block mt-1 w-full bg-gray-100" type="text" name="city_text" :value="old('city_text', $user->city_text)"
                        required autofocus autocomplete="city_text" id="city_text" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('city_text')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="barangay" :value="__('Barangay *')" />
                    <x-text-input id="barangay_text" class="block mt-1 w-full bg-gray-100" type="text" name="barangay_text" :value="old('barangay_text', $user->barangay_text)"
                        required autofocus autocomplete="barangay_text" id="barangay_text" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('barangay_text')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="street" :value="__('Street (Optional) *')" />
                    <x-text-input id="street" class="block mt-1 w-full bg-gray-100" type="text" name="street"
                        :value="old('street', $user->street)" required autofocus autocomplete="street" id="street" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('street')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="zip_code" :value="__('Zip Code*')" />
                    <x-text-input id="zip_code" class="block mt-1 w-full bg-gray-100" type="text" name="zip_code"
                        :value="old('zip_code', $user->zip_code)" required autofocus autocomplete="zip_code" id="zip_code" />
                    <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
                </div>

                @if (session('status') === 'address-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif

            @else
                <div class="col-sm-6 mb-2">
                    <x-input-label for="region" :value="__('Region*')" />
                    <select name="region"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"
                        id="region"></select>
                    <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text"
                        required>
                    @error('region_text')
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
                    @error('province_text')
                        <p class="text-red-500 text-xs p-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="col-sm-6 mb-3">
                    <x-input-label for="city" :value="__('City*')" />
                    <select name="city"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"
                        id="city">
                    </select>
                    <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                    @error('city_text')
                        <p class="text-red-500 text-xs p-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="col-sm-6 mb-3">
                    <x-input-label for="barangay" :value="__('Barangay*')" />
                    <select name="barangay"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2"id="barangay"></select>
                    <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text"
                        required>
                    @error('barangay_text')
                        <p class="text-red-500 text-xs p-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="street" :value="__('Street (Optional) *')" />
                    <x-text-input id="street" class="block mt-1 w-full" type="text" name="street"
                        :value="old('street', $user->street)" required autofocus autocomplete="street" id="street" />
                    <x-input-error class="mt-2" :messages="$errors->get('street')" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-input-label for="zip_code" :value="__('Zip Code*')" />
                    <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code"
                        :value="old('zip_code', $user->zip_code)" required autofocus autocomplete="zip_code" id="zip_code" />
                    <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                    @if (session('status') === 'address-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            @endif

        </div>

    </form>

</section>
