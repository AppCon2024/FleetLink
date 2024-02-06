<div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                class="ri-add-line mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                Add a Supervisor
            </h3>
            <button x-on:click="$dispatch('close-modal')"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
            <!--FirstName -->
            <div>
                <x-input-label for="first_name" :value="__('Firstname')" />
                <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text"
                    name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- LastName -->
            <div>
                <x-input-label for="last_name" :value="__('Lastname')" />
                <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text"
                    name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Department -->
            <div class="mt-2">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                <select name="department" wire:model="department"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2">
                    <option value="" {{ old('department') == '' ? 'selected' : '' }}></option>
                    <option value="Admin PNCO" {{ old('department') == 'Admin PNCO' ? 'selected' : '' }}>Admin PNCO
                    </option>
                    <option value="Operation PNCO" {{ old('department') == 'Operation PNCO' ? 'selected' : '' }}>
                        Operation PNCO</option>
                    <option value="Investigation PNCO"
                        {{ old('department') == 'Investigation PNCO' ? 'selected' : '' }}>
                        Investigation PNCO</option>
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
            <div class="mt-2">
                <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                <select name="position" wire:model="position"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white  mb-2">
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
            <div class="mt-2">
                <x-input-label for="employee_id" :value="__('Employee ID')" />
                <x-text-input wire:model="employee_id" id="employee_id" class="block mt-1 w-full" type="text"
                    name="employee_id" :value="old('employee_id')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

            <button x-on:click="$dispatch('close-modal')"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
            <button wire:click.prevent="create"
                class="ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
        </div>

    </div>
</div>
