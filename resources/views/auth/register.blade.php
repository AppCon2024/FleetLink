<x-guest-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
        @csrf

        <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2">

        <!--FirstName -->
        <div>
            <x-input-label for="first_name" :value="__('Firstname')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- LastName -->
        <div>
            <x-input-label for="last_name" :value="__('Lastname')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>




        <!-- Department -->
        <div class="mt-4">
            <label for="department"
                class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                <select name="department" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2">
                    <option value="" {{old('department') ==  "" ? 'selected' : ''}}></option>
                    <option value="Admin PNCO" {{old('department') ==  "Admin PNCO" ? 'selected' : ''}}>Admin PNCO</option>
                    <option value="Operation PNCO" {{old('department') ==  "Operation PNCO" ? 'selected' : ''}}>Operation PNCO</option>
                    <option value="Investigation PNCO" {{old('department') ==  "Investigation PNCO" ? 'selected' : ''}}>Investigation PNCO</option>
                    <option value="Finance PNCO" {{old('department') ==  "Finance PNCO" ? 'selected' : ''}}>Finance PNCO</option>
                    <option value="Logistics PNCO" {{old('department') ==  "Logistics PNCO" ? 'selected' : ''}}>Logistics PNCO</option>
                    <option value="Police Clearance PNCO" {{old('department') ==  "Police Clearance PNCO" ? 'selected' : ''}}>Police Clearance PNCO</option>
                    <option value="Intel PNCO" {{old('department') ==  "Intel PNCO" ? 'selected' : ''}}>Intel PNCO</option>
                </select>
                @error('department')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>
                @enderror
        </div>

        <!-- Positions -->
        <div class="mt-4">
            <label for="position"
                class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                <select name="position" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white  mb-2">
                    <option value="" {{old('position') ==  "" ? 'selected' : ''}}></option>
                    <option value="Police Captain Deputy" {{old('position') ==  "Police Captain Deputy" ? 'selected' : ''}}>Police Captain Deputy</option>
                    <option value="Police Executive Master Sergeant" {{old('position') ==  "Police Executive Master Sergeant" ? 'selected' : ''}}>Police Executive Master Sergeant</option>
                    <option value="Station's Support and Services Officer" {{old('position') ==  "Station's Support and Services Officer" ? 'selected' : ''}}>Station's Support and Services Officer</option>
                    <option value="Police Lieutenant" {{old('position') ==  "Police Lieutenant" ? 'selected' : ''}}>Police Lieutenant</option>
                    <option value="Police Chief Master Sergeant" {{old('position') ==  "Police Chief Master Sergeant" ? 'selected' : ''}}>Police Chief Master Sergeant</option>
                    <option value="Police Master Sergeant" {{old('position') ==  "Police Master Sergeant" ? 'selected' : ''}}>Police Master Sergeant</option>
                    <option value="Police Staff Sergeant" {{old('position') ==  "Police Staff Sergeant" ? 'selected' : ''}}>Police Staff Sergeant</option>
                    <option value="Police Corporal" {{old('position') ==  "Police Corporal" ? 'selected' : ''}}>Police Corporal</option>
                    <option value="Police Major" {{old('position') ==  "Police Major" ? 'selected' : ''}}>Police Major</option>
                    <option value="Patrolman" {{old('position') ==  "Patrolman" ? 'selected' : ''}}>Patrolman</option>
                    <option value="Patrolwoman" {{old('position') ==  "Patrolwoman" ? 'selected' : ''}}>Patrolwoman</option>
                </select>
                @error('position')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>
                @enderror
        </div>

        <!-- EmployeeId -->
        <div class="mt-4">
            <x-input-label for="employee_id" :value="__('Employee ID')" />
            <x-text-input id="employee_id" class="block mt-1 w-full" type="text" name="employee_id" :value="old('employee_id')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

    </div>

        <!-- Photo -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Your Photo')" />
        <input class="form-control" name="photo" type="file" id="photo">
        @error('photo')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>
                    @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
