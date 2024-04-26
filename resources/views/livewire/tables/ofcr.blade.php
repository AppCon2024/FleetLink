<div>
    <div class="w-auto px-3 overflow-auto">
        <div class="flex overflow-auto">
            @if (Auth::user()->role == 'admin')
                <div class="pr-3 hidden sm:block">
                    @include('includes.sidebar.officer')
                </div>
                <div class="flex-1">
                    <div class="w-full">
                        <div class="bg-white border border-blue-300 rounded-3xl overflow-hidden p-5 shadow-md">
                            <div class="flex items-center justify-between p-4">
                                @include('livewire.includes.search-bar')
                                <div class="flex space-x-3">
                                    @include('livewire.includes.user-status')
                                    <button wire:click="create"
                                        class=" text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs p-2  text-center"><i
                                            class="ri-add-line text-sm"></i>
                                        Add a Officer
                                    </button>
                                    <button onclick="printTable()"
                                        class="text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs px-4 py-2  text-center">
                                        <i class="ri-printer-line text-sm pr-1"></i>
                                        Print
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto relative">
                                <table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                        <tr>
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'name',
                                                'displayName' => 'Name',
                                            ])
                                            <th scope="col" class="px-4 py-3 text-center">Image</th>
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'station',
                                                'displayName' => 'Station',
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
                                                'tablesadb' => 'shift',
                                                'displayName' => 'Shift',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'last_seen',
                                                'displayName' => 'Status',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'status',
                                                'displayName' => 'Account',
                                            ])
                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $ofcr)
                                            <tr wire:key="{{ $ofcr->id }}" class="border-b dark:border-gray-700 hover:bg-gray-100">
                                                <th scope="row"
                                                    class="px-4 py-3 text-xs capitalize font-medium text-blue-600 whitespace-nowrap">
                                                    {{ $ofcr->name }}</th>
                                                <td class="px-2" style="text-align: center;">
                                                    <button wire:click="view({{ $ofcr->id }})">
                                                        <img src="{{ asset($ofcr->image) }}" width='35'
                                                            height="35" class="rounded-md border border-black mt-1">
                                                    </button>
                                                </td>
                                                <td class="px-4 py-3 text-xs text-blue-700">
                                                    {{ $ofcr->station }}</td>
                                                <td class="px-4 py-3 text-xs">{{ $ofcr->department }}</td>
                                                <td class="px-4 py-3 text-xs">{{ $ofcr->position }}</td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center">
                                                        <div>
                                                            @if($ofcr->shift === 'Night')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                                                              </svg>
                                                            @elseif ($ofcr->shift === 'Morning')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="orange" class="w-4 h-4">
                                                                <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                                                              </svg>
                                                            @endif
                                                        </div>
                                                        <span class="text-xs text-gray-900 ml-1">
                                                            {{ $ofcr->shift }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="h-2 w-2 rounded-full bg-{{ $ofcr->last_seen >= now()->subMinutes(2) ? 'green' : 'red' }}-500 me-1 ">
                                                        </div>
                                                        <span class="text-gray-900 text-xs">
                                                            {{ $ofcr->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <a wire:navigate href="ofcr/{{ $ofcr->id }}"
                                                        class= "bg-{{ $ofcr->status ? 'red' : 'green' }}-500 text-white py-1 px-3 rounded text-sm">
                                                        {{ $ofcr->status ? 'Disable' : 'Enable' }}
                                                    </a>
                                                </td>
                                                <td class="px-1">
                                                    <div class="relative flex justify-end items-center">
                                                        <button wire:click="toggleDropdown({{ $ofcr->id }})"
                                                            class="focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6 mt-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                            </svg>
                                                        </button>
                                                        @if ($dropdownId === $ofcr->id)
                                                            <div
                                                                class="absolute z-30 right-5 bg-white shadow-lg rounded-md border">
                                                                <div class="py-1 px-1">
                                                                    <a href=""
                                                                        wire:click.prevent="preview({{ $ofcr->id }})"
                                                                        class="block px-2 py-2 text-xs text-gray-800 hover:bg-gray-200">
                                                                        <div class="flex items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="mr-1 w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                            </svg>
                                                                            Preview
                                                                        </div>
                                                                    </a>
                                                                    <a href=""
                                                                        wire:click.prevent="edit({{ $ofcr->id }})"
                                                                        class="block px-2 py-2 text-xs text-gray-800 hover:bg-gray-200">
                                                                        <div class="flex items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="mr-1 w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                                            </svg>
                                                                            Edit
                                                                        </div>
                                                                    </a>
                                                                    <a href=""
                                                                        wire:click.prevent="delete({{ $ofcr->id }})"
                                                                        class="block px-2 py-2 text-xs text-gray-800 hover:bg-gray-200">
                                                                        <div class="flex items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="mr-1 w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                            </svg>
                                                                            Delete
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    {{-- <button wire:click ="preview({{ $ofcr->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="edit({{ $ofcr->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="delete({{ $ofcr->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b dark:border-gray-700">
                                                <td colspan="3"
                                                    class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                    No officer/s found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @include('livewire.includes.perpage')

                            {{ $data->links() }}

                        </div>

                        @include('livewire.includes.ofcr-modal')

                    </div>
                </div>
            @endif

            @if (Auth::user()->role == 'supervisor')
                <div class="pr-3 hidden sm:block">
                    @include('includes.supv-sidebar.officer')
                </div>
                <div class="flex-1">
                    <div class="w-full">
                        <div class="bg-white border border-blue-300 rounded-3xl overflow-hidden p-5 shadow-md">
                            <h1 class="font-poppins uppercase text-xl font-bold">
                                {{ Auth::user()->station }} officers</h1>
                            <div class="flex items-center justify-between p-4">
                                @include('livewire.includes.search-bar')
                                <div class="flex space-x-3">
                                    @include('livewire.includes.user-status')
                                    <button wire:click="create"
                                        class=" text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs p-2  text-center"><i
                                            class="ri-add-line text-sm"></i>
                                        Add a Officer
                                    </button>
                                    <button onclick="printTable1()"
                                        class="text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs px-4 py-2  text-center">
                                        <i class="ri-printer-line text-sm pr-1"></i>
                                        Print
                                    </button>

                                </div>
                            </div>
                            <div class="overflow-x-auto relative">
                                <table id="myTable1"
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                        <tr>

                                            <th scope="col" class="px-4 py-3">Image</th>
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
                                                'tablesadb' => 'shift',
                                                'displayName' => 'Shift',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'last_seen',
                                                'displayName' => 'Status',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'status',
                                                'displayName' => 'Account',
                                            ])
                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($officer as $ofcr)
                                            <tr wire:key="{{ $ofcr->id }}" class="border-b dark:border-gray-700">
                                                {{-- <th scope="row"
                                                    class="px-4 py-3 text-xs capitalize font-medium text-red-600 whitespace-nowrap">
                                                    {{ $ofcr->station }}</th> --}}
                                                <td class="px-4 py-1">
                                                    <button wire:click="view({{ $ofcr->id }})">
                                                        <img src="{{ asset($ofcr->image) }}" width='35'
                                                            height="35" class="rounded-md border border-black">
                                                    </button>
                                                </td>
                                                <td class="px-4 py-3 text-xs text-blue-700">
                                                    {{ $ofcr->name }}</td>
                                                <td class="px-4 py-3 text-xs">{{ $ofcr->department }}</td>
                                                <td class="px-4 py-3 text-xs">{{ $ofcr->position }}</td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center">
                                                        <div>
                                                            @if($ofcr->shift === 'Night')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                                                              </svg>
                                                            @elseif ($ofcr->shift === 'Morning')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="orange" class="w-4 h-4">
                                                                <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                                                              </svg>
                                                            @endif
                                                        </div>
                                                        <span class="text-xs text-gray-900 ml-1">
                                                            {{ $ofcr->shift }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 ">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="h-2 w-2 rounded-full bg-{{ $ofcr->last_seen >= now()->subMinutes(2) ? 'green' : 'red' }}-500 me-1 ">
                                                        </div>
                                                        <span class="text-gray-900 text-xs">
                                                            {{ $ofcr->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <a wire:navigate href="ofcr/{{ $ofcr->id }}"
                                                        class= "bg-{{ $ofcr->status ? 'red' : 'green' }}-500 text-white py-1 px-3 rounded text-sm">
                                                        {{ $ofcr->status ? 'Disable' : 'Enable' }}
                                                    </a>
                                                </td>
                                                <td class="px-1">
                                                    <div class="relative flex justify-end items-center">
                                                        <button wire:click="toggleDropdown({{ $ofcr->id }})"
                                                            class="focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6 mt-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                            </svg>
                                                        </button>
                                                        @if ($dropdownId === $ofcr->id)
                                                            <div
                                                                class="absolute z-30 right-5 bg-white shadow-lg rounded-md border">
                                                                <div class="py-1 px-1">
                                                                    <a href=""
                                                                        wire:click.prevent="preview({{ $ofcr->id }})"
                                                                        class="block px-2 py-2 text-xs text-gray-800 hover:bg-gray-200">
                                                                        <div class="flex items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="mr-1 w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                            </svg>
                                                                            Preview
                                                                        </div>
                                                                    </a>
                                                                    <a href=""
                                                                        wire:click.prevent="edit({{ $ofcr->id }})"
                                                                        class="block px-2 py-2 text-xs text-gray-800 hover:bg-gray-200">
                                                                        <div class="flex items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="mr-1 w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                                            </svg>
                                                                            Edit
                                                                        </div>
                                                                    </a>
                                                                    <a href=""
                                                                        wire:click.prevent="delete({{ $ofcr->id }})"
                                                                        class="block px-2 py-2 text-xs text-gray-800 hover:bg-gray-200">
                                                                        <div class="flex items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="mr-1 w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                            </svg>
                                                                            Delete
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    {{-- <button wire:click ="preview({{ $ofcr->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="edit({{ $ofcr->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="delete({{ $ofcr->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b dark:border-gray-700">
                                                <td colspan="3"
                                                    class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                    No officer/s found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @include('livewire.includes.perpage')

                            {{ $data->links() }}

                        </div>

                        @include('livewire.includes.ofcr-modal')

                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function printTable() {
        var table = document.getElementById("myTable");
        var newWindow = window.open("", "", "width=1300,height=1000");
        newWindow.document.write("<html><head><title>FleetLink</title>");
        newWindow.document.write("<style>");
        newWindow.document.write("body { background-color: white; }");
        newWindow.document.write("h1 { font-size: 28px; text-align: center; padding: 20px; font-family: abnes; }");
        newWindow.document.write("table { width: 100%; }");
        newWindow.document.write("th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }");
        newWindow.document.write("</style>");
        newWindow.document.write("</head><body>");

        // Create a new table element to hold the selected columns
        var printTable = newWindow.document.createElement("table");

        // Create a new table header row
        var headerRow = printTable.insertRow();

        // Define the custom header text for each column
        var customHeaders = ["Name", "NAME", "STATION", "DEPARTMENT", "POSITION"];

        // Loop through the header cells of the original table
        for (var j = 1; j < table.rows[1].cells.length; j++) {
            // Check if the column index is in the list of columns you want to print
            if ([1, 2, 3, 4].includes(j)) {
                var headerCell = headerRow.insertCell();
                headerCell.innerHTML = customHeaders[j];
                headerCell.style.width = "20%";
            }
        }

        // Loop through the rows of the original table
        for (var i = 1; i < table.rows.length; i++) {
            var row = printTable.insertRow();

            // Loop through the cells of the current row
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                // Check if the column index is in the list of columns you want to print
                if ([0, 2, 3, 4].includes(j)) {
                    var cell = row.insertCell();
                    cell.innerHTML = table.rows[i].cells[j].innerHTML;
                    cell.style.width = "20%";
                }
            }
        }

        // Add a title to the printed output
        newWindow.document.write("<h1>Officers of FleetLink</h1>");
        newWindow.document.write(printTable.outerHTML);
        newWindow.document.write("</body></html>");
        newWindow.document.close();
        newWindow.print();
        newWindow.close();
    }
</script>
<script>
    function printTable1() {
        var table = document.getElementById("myTable1");
        var newWindow = window.open("", "", "width=1300,height=1000");
        newWindow.document.write("<html><head><title>FleetLink</title>");
        newWindow.document.write("<style>");
        newWindow.document.write("body { background-color: white; }");
        newWindow.document.write("h1 { font-size: 28px; text-align: center; padding: 20px; font-family: abnes; }");
        newWindow.document.write("table { width: 100%; }");
        newWindow.document.write("th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }");
        newWindow.document.write("</style>");
        newWindow.document.write("</head><body>");

        // Create a new table element to hold the selected columns
        var printTable = newWindow.document.createElement("table");

        // Create a new table header row
        var headerRow = printTable.insertRow();

        // Define the custom header text for each column
        var customHeaders = ["Name", "NAME", "DEPARTMENT", "POSITION", "SHIFT"];

        // Loop through the header cells of the original table
        for (var j = 1; j < table.rows[1].cells.length; j++) {
            // Check if the column index is in the list of columns you want to print
            if ([1, 2, 3, 4].includes(j)) {
                var headerCell = headerRow.insertCell();
                headerCell.innerHTML = customHeaders[j];
                headerCell.style.width = "20%";
            }
        }

        // Loop through the rows of the original table
        for (var i = 1; i < table.rows.length; i++) {
            var row = printTable.insertRow();

            // Loop through the cells of the current row
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                // Check if the column index is in the list of columns you want to print
                if ([1, 2, 3, 4].includes(j)) {
                    var cell = row.insertCell();
                    cell.innerHTML = table.rows[i].cells[j].innerHTML;
                    cell.style.width = "20%";
                }
            }
        }

        // Add a title to the printed output
        newWindow.document.write("<h1>Officers of {{ $title }}</h1>");
        newWindow.document.write(printTable.outerHTML);
        newWindow.document.write("</body></html>");
        newWindow.document.close();
        newWindow.print();
        newWindow.close();
    }
</script>
