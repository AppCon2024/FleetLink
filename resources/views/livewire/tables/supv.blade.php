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
                <button
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
                            <td class="px-4 py-3 text-green-500">
                                {{ $supv->name }}</td>
                            <td class="px-4 py-3">{{ $supv->department }}</td>
                            <td class="px-4 py-3">{{ $supv->position }}</td>
                            {{-- <td class="px-4 py-3">{{ Carbon\Carbon::parse($supv->last_seen)->diffForHumans() }}</td> --}}
                            <td class="px-4 py-3">
                                <span
                                    class="bg-{{ $supv->last_seen >= now()->subMinutes(2) ? 'green' : 'red' }}-500 text-white py-1 px-3 rounded-full text-sm">
                                    {{ $supv->last_seen >= now()->subMinutes(1) ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td wire:key.live="{{ $supv->id }}" class="px-4 py-3 flex items-center justify-end">
                                <button x-data
                                    x-on:click="$dispatch('open-modal',{ name : 'modal3', id : {{ $supv->id }}})"
                                    class="px-3 py-1 ml-1 bg-blue-500 text-white rounded">Edit</button>
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

</div>
