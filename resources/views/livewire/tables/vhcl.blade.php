<div>
    <div class="w-auto px-3 overflow-auto">
        <div class="flex overflow-auto">
            @if (Auth::user()->role == 'admin')
                <div class="pr-3 hidden sm:block">
                    @include('includes.sidebar.vehicle')
                </div>
                <div class="flex-1">
                    <div class="w-full">
                        <div class="bg-white h-[580px] rounded-3xl overflow-y-auto shadow-md p-5 border border-blue-300">
                            <div class="flex items-center justify-between p-4">
                                @include('livewire.includes.search-bar')
                                <div class="flex space-x-3">
                                    @include('livewire.includes.user-status')
                                    <button wire:click="create"
                                        class=" text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs p-2  text-center"><i
                                            class="ri-add-line text-sm"></i>
                                        Add a Vehicle
                                    </button>
                                    <button onclick="printTable()"
                                        class="text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs px-4 py-2  text-center">
                                        <i class="ri-printer-line text-sm pr-1"></i>
                                        Print
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto relative">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                        <tr>
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'plate',
                                                'displayName' => 'Plate#',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'station',
                                                'displayName' => 'Station',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'brand',
                                                'displayName' => 'Brand',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'model',
                                                'displayName' => 'Model',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'type',
                                                'displayName' => 'Type',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'status',
                                                'displayName' => 'Status',
                                            ])
                                            <th class=" py-3 text-center">
                                                <span>QRCODE</span>
                                            </th>

                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $vhcl)
                                            <tr wire:key="{{ $vhcl->id }}" class="border-b dark:border-gray-700 hover:bg-gray-100">

                                                <td class="px-4 py-1 text-blue-600 font-extrabold">
                                                    {{ $vhcl->plate }}</td>
                                                <td class="px-4 py-1 text-blue-500">
                                                    {{ $vhcl->station }}</td>
                                                <td class="px-4 py-1">
                                                    {{ $vhcl->brand }}</td>
                                                <td class="px-4 py-1">
                                                    {{ $vhcl->model }}</td>
                                                <td class="px-4 py-1">
                                                    @if ($vhcl->type === 'Car')
                                                    <i class="ri-car-fill text-black"></i>
                                                    @elseif ($vhcl->type === 'Motor')
                                                    <i class="ri-motorbike-fill text-black"></i>
                                                    @endif
                                                   {{ $vhcl->type }}</td>
                                                <td class="px-1 py-1">
                                                    <div class="flex items-center">
                                                        <div>
                                                            @if($vhcl->status === '1')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                                              </svg>
                                                            @elseif ($vhcl->status === '0')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                                              </svg>
                                                            @endif
                                                        </div>
                                                        <span class="text-xs text-gray-900 ml-1">
                                                            {{ $vhcl->status == 1 ? 'Available' : 'Unavailable' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="py-2 flex items-center justify-center">
                                                    <button wire:click="view({{ $vhcl->id }})" class="flex items-center justify-center" style="text-align: center">
                                                        <img src="{{ asset($vhcl->qrcode) }}" width='30'
                                                            height="30">
                                                    </button>
                                                </td>
                                                <td class="px-1">
                                                    <div class="relative flex justify-end items-center">
                                                        <button wire:click="toggleDropdown({{ $vhcl->id }})"
                                                            class="focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                            </svg>
                                                        </button>
                                                        @if ($dropdownId === $vhcl->id)
                                                            <div
                                                                class="absolute z-50 right-5 top-auto bg-white shadow-lg rounded-md border">
                                                                <div class="py-1 px-1">
                                                                    <a href=""
                                                                        wire:click.prevent="preview({{ $vhcl->id }})"
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
                                                                        wire:click.prevent="edit({{ $vhcl->id }})"
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
                                                                        wire:click.prevent="delete({{ $vhcl->id }})"
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
                                                    {{-- <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="edit({{ $vhcl->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="delete({{ $vhcl->id }})">
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
                                                    No vehicle/s found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @include('livewire.includes.perpage')

                            {{ $data->links() }}
                        </div>

                        @include('livewire.includes.vehicle-modal')
                    </div>
                </div>
            @endif
            @if (Auth::user()->role == 'supervisor')
                <div class="pr-3 hidden sm:block">
                    @include('includes.supv-sidebar.vehicle')
                </div>
                <div class="flex-1">
                    <div class="w-full">
                        <div class="bg-white h-[580px] rounded-3xl overflow-y-auto shadow-md p-5 border border-blue-300">
                            <h1 class="font-poppins uppercase text-xl font-bold">
                                {{ Auth::user()->station }} Vehicles</h1>
                            <div class="flex items-center justify-between p-4">
                                @include('livewire.includes.search-bar')
                                <div class="flex space-x-3">
                                    @include('livewire.includes.user-status')
                                    <button wire:click="create"
                                        class=" text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs p-2  text-center"><i
                                            class="ri-add-line text-sm"></i>
                                        Add a Vehicle
                                    </button>
                                    <button onclick="printTable()"
                                        class="text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs px-4 py-2  text-center">
                                        <i class="ri-printer-line text-sm pr-1"></i>
                                        Print
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto relative">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                        <tr>
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'plate',
                                                'displayName' => 'Plate#',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'station',
                                                'displayName' => 'Station',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'brand',
                                                'displayName' => 'Brand',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'model',
                                                'displayName' => 'Model',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'type',
                                                'displayName' => 'Type',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'status',
                                                'displayName' => 'Status',
                                            ])
                                            <th class=" py-3 text-center">
                                                <span>QRCODE</span>
                                            </th>

                                            <th scope="col" class="px-4 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($vehicle as $vhcl)
                                            <tr wire:key="{{ $vhcl->id }}" class="border-b dark:border-gray-700 hover:bg-gray-100">

                                                <td class="px-4 py-1 text-blue-600 font-extrabold">
                                                    {{ $vhcl->plate }}</td>
                                                <td class="px-4 py-1 text-blue-500">
                                                    {{ $vhcl->station }}</td>
                                                <td class="px-4 py-1">
                                                    {{ $vhcl->brand }}</td>
                                                <td class="px-4 py-1">
                                                    {{ $vhcl->model }}</td>
                                                    <td class="px-4 py-1">
                                                        @if ($vhcl->type === 'Car')
                                                        <i class="ri-car-fill text-black"></i>
                                                        @elseif ($vhcl->type === 'Motor')
                                                        <i class="ri-motorbike-fill text-black"></i>
                                                        @endif
                                                       {{ $vhcl->type }}</td>
                                                <td class="px-1 py-1">
                                                    <span
                                                        class="bg-{{ $vhcl->status == 1 ? 'green' : 'red' }}-500 text-white py-1 px-3 rounded-full text-xs">
                                                        {{ $vhcl->status == 1 ? 'Available' : 'Unavailable' }}
                                                    </span>
                                                </td>
                                                <td class="py-2 flex items-center justify-center">
                                                    <button wire:click="view({{ $vhcl->id }})" class="flex items-center justify-center" style="text-align: center">
                                                        <img src="{{ asset($vhcl->qrcode) }}" width='30'
                                                            height="30">
                                                    </button>
                                                </td>

                                                <td class="px-1">
                                                    <div class="relative flex justify-end items-center">
                                                        <button wire:click="toggleDropdown({{ $vhcl->id }})"
                                                            class="focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                            </svg>
                                                        </button>
                                                        @if ($dropdownId === $vhcl->id)
                                                            <div
                                                                class="absolute z-50 right-5 top-auto bg-white shadow-lg rounded-md border">
                                                                <div class="py-1 px-1">
                                                                    <a href=""
                                                                        wire:click.prevent="preview({{ $vhcl->id }})"
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
                                                                        wire:click.prevent="edit({{ $vhcl->id }})"
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
                                                                        wire:click.prevent="delete({{ $vhcl->id }})"
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
                                                    {{-- <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="edit({{ $vhcl->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="ml-1 mt-1 w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </button>
                                                    <button class="" wire:click="delete({{ $vhcl->id }})">
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
                                                    No vehicle/s found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @include('livewire.includes.perpage')

                            {{ $data->links() }}
                        </div>

                        @include('livewire.includes.vehicle-modal')
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
