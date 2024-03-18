<div class="w-full">
    <div class="bg-white rounded-3xl overflow-hidden p-5">
        <div class="flex items-center justify-between p-4">
            @include('livewire.includes.search-bar')
            <div class="flex space-x-3">
                @include('livewire.includes.user-status')
                <button wire:click="create"
                    class=" text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs p-2  text-center"><i
                        class="ri-add-line text-sm"></i>
                    Add a Officer
                </button>
                {{-- <button
                    class="text-white border border-gray-300 bg-gray-800 uppercase rounded-lg text-xs p-2  text-center">
                    Export
                </button> --}}
            </div>
        </div>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('id')">ID</th>
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
                    @forelse ($data as $ofcr)
                        <tr wire:key="{{ $ofcr->id }}" class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $ofcr->id }}</th>
                            <td class="px-4 py-1" style="text-align: center;">
                                <button wire:click="view({{ $ofcr->id }})">
                                <img src="{{ asset($ofcr->image) }}" width='30' height="30">
                                </button>
                            </td>
                            <td class="px-4 py-3 text-xs text-blue-700">
                                {{ $ofcr->name }}</td>
                            <td class="px-4 py-3 text-xs">{{ $ofcr->department }}</td>
                            <td class="px-4 py-3 text-xs">{{ $ofcr->position }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="bg-gray-200 border border-gray-400 py-1 px-3 text-xs text-gray-900 rounded-full ">{{ $ofcr->shift }}</span></td>
                            <td class="px-4 py-3 ">
                                <span
                                    class="bg-{{ $ofcr->last_seen >= now()->subMinutes(2) ? 'green' : 'red' }}-500 text-white py-1 px-3 rounded-full text-xs">
                                    {{ $ofcr->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a wire:navigate href="ofcr/{{$ofcr->id}}" class= "bg-{{ $ofcr->status ? 'green' : 'red'}}-500 text-white py-1 px-3 rounded text-sm">
                                    {{ $ofcr->status ? 'Enabled' : 'Disabled'}}
                                </a>
                            </td>
                            <td class="px-1 py-4">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="ml-1 mt-1 w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button class="" wire:click="edit({{ $ofcr->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="ml-1 mt-1 w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                <button class="" wire:click="delete({{ $ofcr->id }})">
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
