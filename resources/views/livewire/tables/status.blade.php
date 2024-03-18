<div class="w-full">
    <div class="bg-white rounded-3xl overflow-hidden p-5">
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
                    <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                    <select
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">All</option>
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3" wire:click="setSortBy('id')">ID</th>
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'first_name',
                            'displayName' => 'Firstname',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'last_name',
                            'displayName' => 'Lastname',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'shift',
                            'displayName' => 'Shift',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'plate',
                            'displayName' => 'plate',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'model',
                            'displayName' => 'Model',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'time_in',
                            'displayName' => 'TimeIn',
                        ])
                        @include('livewire.includes.table-sortable-th', [
                            'tablesadb' => 'time_out',
                            'displayName' => 'TimeOut',
                        ])

                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $stts)
                        <tr wire:key="{{ $stts->id }}" class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $stts->id }}</th>
                            <td class="px-4 py-3">
                                {{ $stts->first_name }}</td>
                            <td class="px-4 py-3">
                                {{ $stts->last_name }}</td>
                            <td class="px-4 py-3">
                                {{ $stts->shift }}</td>
                            <td class="px-4 py-3">
                                {{ $stts->plate }}</td>
                            <td class="px-4 py-3">
                                {{ $stts->model }}</td>
                            <td class="px-4 py-3">
                                {{ $stts->time_in }}</td>
                            <td class="px-4 py-3 text-center">
                                {{ $stts->time_out }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button wire:click="delete({{ $stts->id }})"
                                    class="px-1 hover:bg-gray-200 text-black rounded"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b dark:border-gray-700">
                            <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                No in-use vehicle/s found.
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
</div>
