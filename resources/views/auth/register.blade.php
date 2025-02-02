<x-guest-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
        @csrf

        <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2">

            <!--FirstName -->
            <div>
                <x-input-label for="first_name" :value="__('Firstname')" class="sm:text-sm text-xs" />
                <x-text-input id="first_name" class="block mt-[2px] w-full sm:text-sm text-xs" type="text"
                    name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="p-1" />
            </div>

            <!-- LastName -->
            <div>
                <x-input-label for="last_name" :value="__('Lastname')" class="sm:text-sm text-xs" />
                <x-text-input id="last_name" class="block mt-[2px] w-full sm:text-sm text-xs" type="text" name="last_name" :value="old('last_name')"
                    required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="p-1" />
            </div>

            <!-- Department -->
            <div>
                <label for="department" class="block mb-[2px] w-full sm:text-sm text-xs" font-medium text-gray-900">Deparment</label>
                <select name="department"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2">
                    <option value="" {{ old('department') == '' ? 'selected' : '' }}></option>
                    <option value="Admin PNCO" {{ old('department') == 'Admin PNCO' ? 'selected' : '' }}>Admin PNCO
                    </option>
                    <option value="Operation PNCO" {{ old('department') == 'Operation PNCO' ? 'selected' : '' }}>
                        Operation PNCO</option>
                    <option value="Investigation PNCO"
                        {{ old('department') == 'Investigation PNCO' ? 'selected' : '' }}>Investigation PNCO</option>
                    <option value="Finance PNCO" {{ old('department') == 'Finance PNCO' ? 'selected' : '' }}>Finance
                        PNCO</option>
                    <option value="Logistics PNCO" {{ old('department') == 'Logistics PNCO' ? 'selected' : '' }}>
                        Logistics PNCO</option>
                    <option value="Police Clearance PNCO"
                        {{ old('department') == 'Police Clearance PNCO' ? 'selected' : '' }}>Police Clearance PNCO
                    </option>
                    <option value="Intel PNCO" {{ old('department') == 'Intel PNCO' ? 'selected' : '' }}>Intel PNCO
                    </option>
                </select>
                @error('department')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Positions -->
            <div>
                <label for="position" class="block mb-[2px] w-full sm:text-sm text-xs font-medium text-gray-900">Position</label>
                <select name="position"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white  mb-2">
                    <option value="" {{ old('position') == '' ? 'selected' : '' }}></option>
                    <option value="Police Captain Deputy"
                        {{ old('position') == 'Police Captain Deputy' ? 'selected' : '' }}>Police Captain Deputy
                    </option>
                    <option value="Police Executive Master Sergeant"
                        {{ old('position') == 'Police Executive Master Sergeant' ? 'selected' : '' }}>Police Executive
                        Master Sergeant</option>
                    <option value="Station's Support and Services Officer"
                        {{ old('position') == "Station's Support and Services Officer" ? 'selected' : '' }}>Station's
                        Support and Services Officer</option>
                    <option value="Police Lieutenant" {{ old('position') == 'Police Lieutenant' ? 'selected' : '' }}>
                        Police Lieutenant</option>
                    <option value="Police Chief Master Sergeant"
                        {{ old('position') == 'Police Chief Master Sergeant' ? 'selected' : '' }}>Police Chief Master
                        Sergeant</option>
                    <option value="Police Master Sergeant"
                        {{ old('position') == 'Police Master Sergeant' ? 'selected' : '' }}>Police Master Sergeant
                    </option>
                    <option value="Police Staff Sergeant"
                        {{ old('position') == 'Police Staff Sergeant' ? 'selected' : '' }}>Police Staff Sergeant
                    </option>
                    <option value="Police Corporal" {{ old('position') == 'Police Corporal' ? 'selected' : '' }}>
                        Police Corporal</option>
                    <option value="Police Major" {{ old('position') == 'Police Major' ? 'selected' : '' }}>Police
                        Major</option>
                    <option value="Patrolman" {{ old('position') == 'Patrolman' ? 'selected' : '' }}>Patrolman
                    </option>
                    <option value="Patrolwoman" {{ old('position') == 'Patrolwoman' ? 'selected' : '' }}>Patrolwoman
                    </option>
                </select>
                @error('position')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- EmployeeId -->
            <div>
                <x-input-label for="employee_id" :value="__('Employee ID')" class="sm:text-sm text-xs" />
                <x-text-input id="employee_id" class="block mt-[2px] w-full sm:text-sm text-xs" type="text" name="employee_id"
                    :value="old('employee_id')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('employee_id')" class="p-1" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="sm:text-sm text-xs" />
                <x-text-input id="email" class="block mt-[2px] w-full sm:text-sm text-xs" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="p-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="sm:text-sm text-xs" />

                <x-text-input id="password" class="block mt-[2px] w-full sm:text-sm text-xs" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="p-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="sm:text-sm text-xs" />

                <x-text-input id="password_confirmation" class="block mt-[2px] w-full sm:text-sm text-xs" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="p-1" />
            </div>

           
            <!--Station-->
            <div>
                <label for="station" class="block mb-[2px] w-full sm:text-sm text-xs font-medium text-gray-900">Station</label>
                <select name="station"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    <option value="" {{ old('station') == '' ? 'selected' : '' }}></option>
                    <option value="Station 1" {{ old('station') == 'Station 1' ? 'selected' : '' }}>Station 1</option>
                    <option value="Station 2" {{ old('station') == 'Station 2' ? 'selected' : '' }}>Station 2</option>
                    <option value="Station 3" {{ old('station') == 'Station 3' ? 'selected' : '' }}>Station 3</option>
                    <option value="Station 4" {{ old('station') == 'Station 4' ? 'selected' : '' }}>Station 4</option>
                    <option value="Station 5" {{ old('station') == 'Station 5' ? 'selected' : '' }}>Station 5</option>
                    <option value="Station 6" {{ old('station') == 'Station 6' ? 'selected' : '' }}>Station 6</option>
                    <option value="Station 7" {{ old('station') == 'Station 7' ? 'selected' : '' }}>Station 7</option>
                    <option value="Station 8" {{ old('station') == 'Station 8' ? 'selected' : '' }}>Station 8</option>
                    <option value="Station 9" {{ old('station') == 'Station 9' ? 'selected' : '' }}>Station 9</option>
                    <option value="Station 10" {{ old('station') == 'Station 10' ? 'selected' : '' }}>Station 10</option>
                    <option value="Station 11" {{ old('station') == 'Station 11' ? 'selected' : '' }}>Station 11</option>
                    <option value="Station 12" {{ old('station') == 'Station 12' ? 'selected' : '' }}>Station 12</option>
                </select>
                @error('station')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <!--Shift-->
            <div>
                <label for="shift" class="block mb-[2px] w-full sm:text-sm text-xs font-medium text-gray-900">Shift</label>
                <select name="shift"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    <option value="" {{ old('shift') == '' ? 'selected' : '' }}></option>
                    <option value="Morning" {{ old('shift') == 'Morning' ? 'selected' : '' }}>
                        Morning</option>
                    <option value="Night" {{ old('shift') == 'Night' ? 'selected' : '' }}>Night
                    </option>
                </select>
                @error('shift')
                    <p class="text-red-500 text-xs p-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

         <!--Upload Image-->
         <div>
            <x-input-label for="password_confirmation" :value="__('Your Photo')" class="sm:text-sm text-xs mb-[2px]" />
            <input class=" sm:text-sm text-xs rounded-md w-full border border-gray-200 bg-gray-50" name="image" type="file" id="image">
            @error('image')
                <p class="text-red-500 text-xs p-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex items-center justify-center mt-4">
                <x-primary-button class="sm:w-9/12 w-full flex items-center justify-center">
                    {{ __('Register') }}
                </x-primary-button>
        </div>

        <div class="flex items-center justify-between mt-2">
            <a href="{{ asset('/') }}"
                class="text-gray-600 sm:text-sm text-xs hover:underline">
                Back
            </a>
            <a class="underline sm:text-sm text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

    </form>
</x-guest-layout>
