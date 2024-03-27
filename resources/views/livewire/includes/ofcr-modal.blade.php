@if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
        class="bg-blue-200 fixed m-10 bottom-0 right-0 z-20 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md"
        role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-blue-700 mr-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                </svg></div>
            <div>
                <p class="font-bold text-black">Alert Message</p>
                <p class="text-sm text-black">{{ session('message') }}</p>
            </div>
        </div>
    </div>
@endif

@if ($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="relative bg-white p-4 rounded-xl shadow-lg sm:max-w-2xl max-w-xs ">
            <!-- Modal content goes here -->
            <div class="flex items-center justify-between pb-2 md:pb-3 border-b border-gray-500">
                <h2 class="pl-2 sm:text-xl text-sm font-semibold text-gray-900 dark:text-white">
                    @if ($postId)
                        <i class="ri-edit-2-fill mr-1 sm:text-lg text-sm bg-blue-300 p-2.5 rounded-full"></i> Edit
                        {{ $name }}'s Information
                    @else
                        <i class="ri-add-line mr-1 sm:text-lg text-sm bg-blue-300 p-2.5 rounded-full"></i> Add a Officer
                        Account
                    @endif
                </h2>
                <button wire:click.prevent="$set('isOpen', false)"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    title="Close Modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span></button>
            </div>

            <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}">

                <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">

                    <div class="flex flex-row justify-center items-center">

                        @if ($postId)
                            <div class="flex flex-col justify-center items-center">
                                <img src="{{ $image }}" width='120' class="border border-blue-400 p-1">
                                @if ($newImage)
                                    <x-input-label for="image" :value="__('Old Image')" />
                                @else
                                    <x-input-label for="image" :value="__('Image')" />
                                @endif
                            </div>

                            <div class="flex flex-col justify-center items-center ml-7">
                                @if ($newImage)
                                    <img width='120' src="{{ $newImage->temporaryUrl() }}"
                                        class="border border-blue-400 p-1">
                                    <x-input-label for="image" :value="__('New Image')" />
                                @endif
                            </div>
                        @else
                            @if ($image)
                                <div class="flex flex-col justify-center items-center">
                                    <img width='120' src="{{ $image->temporaryUrl() }}"
                                        class="border border-blue-400 p-1">
                                    <x-input-label for="image" :value="__('Image Preview')" class="pt-1" />
                                </div>
                            @else
                                <x-input-label for="image" :value="__('Image preview will be shown here.')" />
                            @endif

                        @endif

                    </div>

                    <!--Upload Image-->
                    <div class="flex flex-col justify-end">
                        @if ($postId)
                            <x-input-label for="profile_picture" :value="$postId ? __('Update Image') : __('Image')" />
                            <input wire:model="newImage" accept="image/png, image/jpeg" type="file" id="image"
                                class="ring-1 ring-inset ring-blue-300 bg-blue-100 text-gray-900 sm:text-sm text-xs rounded block w-full">
                            @error('image')
                                <p class="text-red-500 text-xs p-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        @else
                            <x-input-label for="profile_picture" :value="$postId ? __('Update Image') : __('Image')" />
                            <input wire:model="image" accept="image/png, image/jpeg" type="file" id="image"
                                class="ring-1 ring-inset ring-blue-300 bg-blue-100 text-gray-900 sm:text-sm text-xs rounded block w-full">
                            @error('image')
                                <p class="text-red-500 text-xs p-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>


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
                            <option value="" {{ old('department') == '' ? 'selected' : '' }}>
                            </option>
                            <option value="Admin PNCO" {{ old('department') == 'Admin PNCO' ? 'selected' : '' }}>
                                Admin PNCO
                            </option>
                            <option value="Operation PNCO"
                                {{ old('department') == 'Operation PNCO' ? 'selected' : '' }}>
                                Operation PNCO</option>
                            <option value="Investigation PNCO"
                                {{ old('department') == 'Investigation PNCO' ? 'selected' : '' }}>
                                Investigation PNCO</option>
                            <option value="Finance PNCO" {{ old('department') == 'Finance PNCO' ? 'selected' : '' }}>
                                Finance
                                PNCO</option>
                            <option value="Logistics PNCO"
                                {{ old('department') == 'Logistics PNCO' ? 'selected' : '' }}>
                                Logistics PNCO</option>
                            <option value="Police Clearance PNCO"
                                {{ old('department') == 'Police Clearance PNCO' ? 'selected' : '' }}>
                                Police Clearance PNCO
                            </option>
                            <option value="Intel PNCO" {{ old('department') == 'Intel PNCO' ? 'selected' : '' }}>
                                Intel PNCO
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
                            <option value="" {{ old('position') == '' ? 'selected' : '' }}>
                            </option>
                            <option value="Police Captain Deputy"
                                {{ old('position') == 'Police Captain Deputy' ? 'selected' : '' }}>
                                Police Captain Deputy
                            </option>
                            <option value="Police Executive Master Sergeant"
                                {{ old('position') == 'Police Executive Master Sergeant' ? 'selected' : '' }}>
                                Police Executive
                                Master Sergeant</option>
                            <option value="Station Support and Services Officer"
                                {{ old('position') == 'Station Support and Services Officer' ? 'selected' : '' }}>
                                Station
                                Support and Services Officer</option>
                            <option value="Police Lieutenant"
                                {{ old('position') == 'Police Lieutenant' ? 'selected' : '' }}>
                                Police Lieutenant</option>
                            <option value="Police Chief Master Sergeant"
                                {{ old('position') == 'Police Chief Master Sergeant' ? 'selected' : '' }}>
                                Police Chief Master
                                Sergeant</option>
                            <option value="Police Master Sergeant"
                                {{ old('position') == 'Police Master Sergeant' ? 'selected' : '' }}>
                                Police Master Sergeant
                            </option>
                            <option value="Police Staff Sergeant"
                                {{ old('position') == 'Police Staff Sergeant' ? 'selected' : '' }}>
                                Police Staff Sergeant
                            </option>
                            <option value="Police Corporal"
                                {{ old('position') == 'Police Corporal' ? 'selected' : '' }}>
                                Police Corporal</option>
                            <option value="Police Major" {{ old('position') == 'Police Major' ? 'selected' : '' }}>
                                Police
                                Major</option>
                            <option value="Patrolman" {{ old('position') == 'Patrolman' ? 'selected' : '' }}>
                                Patrolman
                            </option>
                            <option value="Patrolwoman" {{ old('position') == 'Patrolwoman' ? 'selected' : '' }}>
                                Patrolwoman
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
                        <x-text-input wire:model="employee_id" id="employee_id" class="block mt-1 w-full"
                            type="text" name="employee_id" :value="old('employee_id')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-2">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email"
                            name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="shift"
                            class="block mb-[2px] w-full sm:text-sm text-xs font-medium text-gray-900">Shift</label>
                        <select name="shift" wire:model="shift"
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
                    @if (Auth::user()->role == 'admin')
                        <div>
                            <label for="station"
                                class="block mb-[2px] w-full sm:text-sm text-xs font-medium text-gray-900">Station</label>
                            <select name="station" wire:model="station"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="" {{ old('station') == '' ? 'selected' : '' }}></option>
                                <option value="Station 1" {{ old('station') == 'Station 1' ? 'selected' : '' }}>
                                    Station 1</option>
                                <option value="Station 2" {{ old('station') == 'Station 2' ? 'selected' : '' }}>
                                    Station 2</option>
                            </select>
                            @error('station')
                                <p class="text-red-500 text-xs p-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @else
                        {{-- <div>
                        <label for="station" class="block mb-[2px] w-full sm:text-sm text-xs font-medium text-gray-900">Station</label>
                        <select name="station" wire:model="station"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option value="" {{ old('station') == '' ? 'selected' : '' }}></option>
                            <option value="Station 1" {{ old('station') == 'Station 1' ? 'selected' : '' }}>Station 1</option>
                            <option value="Station 2" {{ old('station') == 'Station 2' ? 'selected' : '' }}>Station 2</option>
                        </select>
                        @error('station')
                            <p class="text-red-500 text-xs p-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div> --}}
                    @endif
                </div>

                <!--Buttons-->
                <div class="flex justify-end">
                    <button type="button"
                        class= "mr-4 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        wire:click="closeModal">Cancel</button>
                    <button type="submit"
                        class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $postId ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>

        </div>
    </div>
@endif

@if ($deleteOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white p-4 rounded-xl shadow-lg ">
            <!-- Modal content goes here -->
            <button wire:click.prevent="$set('deleteOpen', false)"
                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            <form wire:submit.prevent="remove">
                <p class="mb-4 text-gray-500 dark:text-gray-300">
                    Are you sure you want to delete {{ $name }}'s account?
                </p>
                <div class="flex justify-center items-center space-x-4">
                    <button wire:click="deleteCloseModal"
                        class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                    <button type="submit"
                        class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Yes, I'm sure
                    </button>
            </form>
        </div>
    </div>
    </div>
@endif

@if ($imageOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white p-4 rounded-xl shadow-lg ">
            <!-- Modal content goes here -->
            <p>{{ $name }}</p>
            <button wire:click.prevent="$set('imageOpen', false)"
                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <p class="mb-4 text-gray-500 dark:text-gray-300">
                <img src="{{ $image }}" width='100' height='100'>
            </p>
            <div class="flex justify-center items-center space-x-4">
                <button wire:click="closeImageModal"
                    class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    No, cancel
                </button>
                <button type="submit"
                    class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                    Yes, I'm sure
                </button>
            </div>
        </div>
    </div>
@endif

@if ($infoOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white p-4 rounded-xl shadow-lg w-11/12 sm:overflow-auto overflow-scroll"
            style="max-height:80vh;">
            <!-- header -->
            <div class="flex items-center justify-between pb-2 md:pb-3 border-b border-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                </svg>
                <h2 class="pl-2 sm:text-xl text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $name }}'s Information
                </h2>
                <button wire:click.prevent="$set('infoOpen', false)"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    title="Close Modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span></button>
            </div>
            <!-- header -->

            <!--Body-->
            <div class="grid gap-5 mb-4 mt-4 sm:grid-cols-2">
                <div class="grid gap-3 mb-4 grid-cols-2 ">
                    <div class="flex justify-center col-span-2 border-b-2 border-black  ">
                        <h2 class="flex flex-row items-center text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>

                            {{ __('Profile Information') }}
                        </h2>
                    </div>
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">{{ $name }}
                        </h1>
                    </div>
                    <div>
                        <x-input-label for="department" :value="__('Depatrment')" />
                        <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">{{ $department }}
                        </h1>
                    </div>
                    <div>
                        <x-input-label for="position" :value="__('Position')" />
                        <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">{{ $position }}
                        </h1>
                    </div>
                    <div>
                        <x-input-label for="employee_id" :value="__('employee_id')" />
                        <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">{{ $employee_id }}
                        </h1>
                    </div>
                    <div>
                        <x-input-label for="position" :value="__('Email')" />
                        <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">{{ $email }}
                        </h1>
                    </div>
                    <div>
                        <x-input-label for="position" :value="__('shift')" />
                        <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">{{ $shift }}
                        </h1>
                    </div>
                </div>
                <div class="grid gap-3 mb-4 grid-cols-2">
                    <div class="flex justify-center col-span-2 border-b-2 border-black  ">
                        <h2 class="flex flex-row items-center text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            {{ __('Main Address') }}
                        </h2>
                    </div>
                    <div>
                        <x-input-label for="region" :value="__('region')" />
                        @if ($region)
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">
                                {{ $region }}
                            </h1>
                        @else
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm text-red-500">No Information
                                available.
                            </h1>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="province" :value="__('Province')" />
                        @if ($province)
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">
                                {{ $province }}
                            </h1>
                        @else
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm text-red-500">No Information
                                available.
                            </h1>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="city" :value="__('City')" />
                        @if ($city)
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">
                                {{ $city }}
                            </h1>
                        @else
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm text-red-500">No Information
                                available.
                            </h1>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="barangay" :value="__('Barangay')" />
                        @if ($barangay)
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">
                                {{ $barangay }}
                            </h1>
                        @else
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm text-red-500">No Information
                                available.
                            </h1>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="street" :value="__('Street')" />
                        @if ($street)
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">
                                {{ $street }}
                            </h1>
                        @else
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm text-red-500">No Information
                                available.
                            </h1>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="zip" :value="__('Zip Code')" />
                        @if ($zip)
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm">
                                {{ $zip }}
                            </h1>
                        @else
                            <h1 class="w-full bg-gray-100 border border-gray-200 px-4 py-2 rounded-md text-xs sm:text-sm text-red-500">No Information
                                available.
                            </h1>
                        @endif
                    </div>
                </div>
            </div>
            <!--Body-->

            <!--Buttons-->
            <div class="flex justify-end items-center space-x-4">
                <button wire:click.prevent="$set('infoOpen', false)"
                    class="py-2 px-5 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Close
                </button>
                <button wire:click="edit({{ $postId }})"
                    class="py-2 px-5 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-900">
                    Edit
                </button>
            </div>
            <!--Buttons-->

        </div>
    </div>
@endif
