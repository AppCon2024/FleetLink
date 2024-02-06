<div class="relative top-[70px] md:w-[calc(100%-256px)] md:ml-64 xl:w-[80%] mx-auto px-2 p-5 rounded-lg bg-gray-100">

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
                    <select wire:model.live="last_seen"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">All</option>
                        <option value="0">Online</option>
                        <option value="1">Offline</option>
                    </select>
                </div>
                <button x-data x-on:click="$dispatch('open-modal',{ name : 'add-supv'})"
                    class=" text-white border border-gray-300 bg-blue-500 uppercase rounded-lg text-xs p-2  text-center"><i
                        class="ri-add-line text-sm"></i>
                    Add Supervisor</button>
                <button
                    class=" text-white border border-gray-300 bg-gray-900 uppercase rounded-lg text-xs p-2  text-center">
                    Export</button>
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
                        {{-- @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'last_seen',
                            'displayName' => 'Last Seen',
                        ]) --}}
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'last_seen',
                            'displayName' => 'Status',
                        ])
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $supv)
                        {{-- <td class="px-4 py-3">{{ Carbon\Carbon::parse($supv->last_seen)->diffForHumans() }}</td> --}}
                        <tr wire:key="{{ $supv->id }}" class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $supv->id }}</th>
                            <td class="px-4 py-3"><img src="{{ asset($supv->photo) }}" width='30' height="30">
                            </td>
                            <td class="px-4 py-3 text-blue-500">
                                {{ $supv->name }}</td>
                            <td class="px-4 py-3">{{ $supv->department }}</td>
                            <td class="px-4 py-3">{{ $supv->position }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="bg-{{ $supv->last_seen >= now()->subMinutes(2) ? 'green' : 'red' }}-500 text-white py-1 px-3 rounded-full text-sm">
                                    {{ $supv->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td class="px-1 py-3">
                                <button wire:click="delete({{ $supv->id }})"
                                    class="px-3 py-1 ml-1 bg-red-500 text-white rounded">Delete</button>
                            </td>
                            <td class="px-1 py-3">
                                <button wire:click="preview({{ $supv->id }})"
                                    class="px-3 py-1 ml-1 bg-blue-500 text-white rounded">Preview</button>
                            </td>
                            <td class="px-1 py-3">
                                <button wire:click="edit({{ $supv->id }})"
                                    class="px-3 py-1 ml-1 bg-yellow-500 text-white rounded">Edit</button>
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


        @if ($selectedUser)
            <x-delete-modal name="delete">
                <x-slot:body>
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button x-on:click="$dispatch('close-modal')"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you
                                    want to delete this User?</h3>
                                <button wire:click="delete_copy({{ $selectedUser }})"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Yes, I'm sure
                                </button>
                                <button x-on:click="$dispatch('close-modal')"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                    cancel</button>
                            </div>
                        </div>
                    </div>

                </x-slot:body>
            </x-delete-modal>

            <x-delete-modal name="preview">
                <x-slot:body>
                    <div class="relative p-4 w-full max-w-3xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                        class="ri-add-line mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                    {{ $selectedUser->name }}'s Information
                                </h3>
                                <button x-on:click="$dispatch('close-modal')"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                                <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                                    <!--FirstName -->
                                    <div>
                                        <x-input-label for="first_name" :value="__('Firstname')" />
                                        <input value="{{ $selectedUser->first_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- LastName -->
                                    <div>
                                        <x-input-label for="last_name" :value="__('Lastname')" />
                                        <input type="text" name="id" value="{{ $selectedUser->last_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Department -->
                                    <div class="mt-2">
                                        <label for="department"
                                            class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                                        <input type="text" name="id" value="{{ $selectedUser->department }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Positions -->
                                    <div class="mt-2">
                                        <label for="position"
                                            class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                                        <input value="{{ $selectedUser->position }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- EmployeeId -->
                                    <div class="mt-2">
                                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                                        <input value="{{ $selectedUser->employee_id }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-2">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <input value="{{ $selectedUser->email }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>
                                </div>
                                <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                                    <!--FirstName -->
                                    <div>
                                        <x-input-label for="first_name" :value="__('Firstname')" />
                                        <input value="{{ $selectedUser->first_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- LastName -->
                                    <div>
                                        <x-input-label for="last_name" :value="__('Lastname')" />
                                        <input type="text" name="id" value="{{ $selectedUser->last_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Department -->
                                    <div class="mt-2">
                                        <label for="department"
                                            class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                                        <input type="text" name="id" value="{{ $selectedUser->department }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Positions -->
                                    <div class="mt-2">
                                        <label for="position"
                                            class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                                        <input value="{{ $selectedUser->position }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- EmployeeId -->
                                    <div class="mt-2">
                                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                                        <input value="{{ $selectedUser->employee_id }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-2">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <input value="{{ $selectedUser->email }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

                                <button x-on:click="$dispatch('close-modal')"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                <button wire:click.prevent="create"
                                    class="ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                            </div>

                        </div>
                    </div>
                </x-slot:body>
            </x-delete-modal>

            <x-delete-modal name="edit">
                <x-slot:body>
                    <div class="relative p-4 w-full max-w-3xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                        class="ri-add-line mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                    {{ $selectedUser->name }}'s Information
                                </h3>
                                <button x-on:click="$dispatch('close-modal')"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                                <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                                    <!--FirstName -->
                                    <div>
                                        <x-input-label for="first_name" :value="__('Firstname')" />
                                        <input
                                            wire:model="first_name"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                             />
                                    </div>

                                    <!-- LastName -->
                                    <div>
                                        <x-input-label for="last_name" :value="__('Lastname')" />
                                        <input
                                            wire:model="last_name" value="{{ $selectedUser->last_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                             />
                                    </div>

                                    <!-- Department -->
                                    <div class="mt-2">
                                        <label for="department"
                                            class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                                        <input type="text" name="id" value="{{ $selectedUser->department }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Positions -->
                                    <div class="mt-2">
                                        <label for="position"
                                            class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                                        <input value="{{ $selectedUser->position }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- EmployeeId -->
                                    <div class="mt-2">
                                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                                        <input value="{{ $selectedUser->employee_id }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-2">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <input value="{{ $selectedUser->email }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>
                                </div>
                                <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">
                                    <!--FirstName -->
                                    <div>
                                        <x-input-label for="first_name" :value="__('Firstname')" />
                                        <input value="{{ $selectedUser->first_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- LastName -->
                                    <div>
                                        <x-input-label for="last_name" :value="__('Lastname')" />
                                        <input type="text" name="id" value="{{ $selectedUser->last_name }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Department -->
                                    <div class="mt-2">
                                        <label for="department"
                                            class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                                        <input type="text" name="id" value="{{ $selectedUser->department }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Positions -->
                                    <div class="mt-2">
                                        <label for="position"
                                            class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                                        <input value="{{ $selectedUser->position }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- EmployeeId -->
                                    <div class="mt-2">
                                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                                        <input value="{{ $selectedUser->employee_id }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-2">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <input value="{{ $selectedUser->email }}"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mt-1"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

                                <button x-on:click="$dispatch('close-modal')"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                <button wire:click.prevent="edit_copy({{ $selectedUser }})"
                                    class="ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                            </div>

                        </div>
                    </div>
                </x-slot:body>
            </x-delete-modal>
        @endif


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

</div>
