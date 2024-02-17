<div
    class="relative top-[70px] md:w-[calc(100%-256px)] md:ml-64 xl:w-[80%] mx-auto px-2 p-5 rounded-xl md:rounded-lg bg-gray-100">

    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800  shadow-md sm:rounded-lg overflow-hidden p-5">
        <div class="flex items-center justify-between p-4">
            <div class="flex">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms = "search" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                        placeholder="Search" required="">
                </div>
            </div>
            <div class="flex space-x-3">
                <div class="flex space-x-3 items-center">
                    <label class="w-40 text-sm font-medium text-gray-900">User Status :</label>
                    <select wire:model="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">All</option>
                        <option value="0">Online</option>
                        <option value="1">Offline</option>
                    </select>
                </div>
                <button wire:click="create"
                    class=" text-white border border-gray-300 bg-blue-500 uppercase rounded-lg text-xs p-2  text-center"><i
                        class="ri-add-line text-sm"></i>
                    Add Supervisor
                </button>
                <button
                    class="text-white border border-gray-300 bg-gray-900 uppercase rounded-lg text-xs p-2  text-center">
                    Export
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('id')">ID</th>
                        <th scope="col" class="px-4 py-3">Photo</th>
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'name',
                            'displayName' => 'Name',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'department',
                            'displayName' => 'Department',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'position',
                            'displayName' => 'Position',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'last_seen',
                            'displayName' => 'Status',
                        ])
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $supv)
                        <tr wire:key="{{ $supv->id }}" class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $supv->id }}</th>
                            <td class="px-4 py-3"><img src="{{ asset($supv->photo) }}" width='30' height="30">
                            </td>
                            <td class="px-4 py-3 text-blue-500">{{ $supv->name }}</td>
                            <td class="px-4 py-3">{{ $supv->department }}</td>
                            <td class="px-4 py-3">{{ $supv->position }}</td>
                            <td class="px-4 py-3 ">
                                <span
                                    class="bg-{{ $supv->last_seen >= now()->subMinutes(2) ? 'green' : 'red' }}-500 text-white py-1 px-3 rounded-full text-sm">
                                    {{ $supv->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td class="px-1 py-3">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="ml-1 mt-1 w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button class="" wire:click="edit({{ $supv->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="ml-1 mt-1 w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                <button class="" wire:click="delete({{ $supv->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="ml-1 mt-1 w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr class="border-b dark:border-gray-700">
                            <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                No supervisor/s found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="py-4 px-3">
            <div class="flex ">
                <div class="flex space-x-4 items-center mb-3">
                    <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                    <select wire:model.live='perPage'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>

        {{ $data->links() }}
    </div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="bg-blue-200 fixed m-10 bottom-0 right-0 z-20 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md"
            role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-blue-700 mr-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white p-4 rounded-xl shadow-lg w-1/2 ">
                <!-- Modal content goes here -->
                <div class="flex items-center justify-between pb-2 md:pb-3 border-b border-gray-500">
                    <h2 class="pl-4 text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $postId ? 'Edit User Information' : 'Add a Supervisor' }}</h2>
                    <button wire:click.prevent="$set('isOpen', false)"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span></button>
                </div>

                <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}">

                    <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                        <!--FirstName -->
                        <div>
                            <x-input-label for="first_name" :value="__('Firstname')" />
                            <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full"
                                type="text" name="first_name" :value="old('first_name')" required autofocus
                                autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- LastName -->
                        <div>
                            <x-input-label for="last_name" :value="__('Lastname')" />
                            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full"
                                type="text" name="last_name" :value="old('last_name')" required autofocus
                                autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Department -->
                        <div class="mt-2">
                            <label for="department"
                                class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
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
                                <option value="Finance PNCO"
                                    {{ old('department') == 'Finance PNCO' ? 'selected' : '' }}>Finance
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
                            <label for="position"
                                class="block mb-2 text-sm font-medium text-gray-900">Position</label>
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
                                <option value="Station's Support and Services Officer"
                                    {{ old('position') == "Station's Support and Services Officer" ? 'selected' : '' }}>
                                    Station's
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
                                <option value="Police Major"
                                    {{ old('position') == 'Police Major' ? 'selected' : '' }}>Police
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
                                type="text" name="employee_id" :value="old('employee_id')" required
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email"
                                name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!--Buttons-->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="mr-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ $postId ? 'Update' : 'Create' }}
                        </button>
                        <button type="button"
                            class= "text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            wire:click="closeModal">Cancel</button>
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
                    <button wire:click.prevent="$set('deleteOpen', false)" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <form wire:submit.prevent="remove">
                    <p class="mb-4 text-gray-500 dark:text-gray-300">
                        Are you sure you want to delete {{ $name }}'s account?
                    </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="deleteCloseModal" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </form>
                    </div>
            </div>
        </div>
    @endif

</div>
