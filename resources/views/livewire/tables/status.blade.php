<div>
    <div class="w-auto px-3 overflow-auto">
        <div class="flex overflow-auto">
            @if (Auth::user()->role == 'admin')
                <div class="pr-3 hidden sm:block">
                    @include('includes.sidebar.status')
                </div>
                <div class="flex-1">
                    <div class="w-full">
                        <div class="bg-white rounded-3xl overflow-hidden p-5">
                            <div class="flex items-center justify-between p-4">
                                @include('livewire.includes.search-bar')
                                {{-- <div class="flex space-x-3">
                                    @include('livewire.includes.user-status')
                                </div> --}}
                                <div class="flex">
                                    <div class=>
                                        <label for="startdate" class="text-xs text-gray-700 uppercase">Start Date:</label>
                                        <input type="date" wire:model.live="start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 pl-10 ">
                                    </div>
                                    <div class="px-4">
                                        <label for="startdate" class="text-xs text-gray-700 uppercase">End Date:</label>
                                        <input type="date" wire:model.live="end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 pl-10 ">
                                    </div>
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
                                            {{-- <th scope="col" class="px-4 py-3" wire:click="setSortBy('id')">ID</th> --}}
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'id',
                                                'displayName' => 'Name',
                                            ])
                                            @include('livewire.includes.table-sortable-th', [
                                                'tablesadb' => 'id',
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
                                                {{-- <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $stts->id }}</th> --}}
                                                <td class="px-4 py-3">
                                                    {{ $stts->user->name }} {{ $stts->last_name }}</td>
                                                <td class="px-4 py-3">
                                                    <span
                                                        class="bg-gray-200 border border-gray-400 py-1 px-3 text-xs text-gray-900 rounded-full ">{{ $stts->user->shift }}</span>
                                                </td>
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
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b dark:border-gray-700">
                                                <td colspan="3"
                                                    class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
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
                </div>
            @endif
            @if (Auth::user()->role == 'supervisor')
                <div class="pr-3 hidden sm:block">
                    @include('includes.supv-sidebar.status')
                </div>
                <div class="flex-1">
                    <div class="w-full">
                        <div class="bg-white rounded-3xl overflow-hidden p-5">
                            <div class="flex items-center justify-between p-4">
                                <div class="flex">
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
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
                                                'tablesadb' => 'name',
                                                'displayName' => 'name',
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
                                                    {{ $stts->user->name }}</td>
                                                
                                                <td class="px-4 py-3">
                                                    <span
                                                        class="bg-gray-200 border border-gray-400 py-1 px-3 text-xs text-gray-900 rounded-full ">{{ $stts->user->shift }}</span>
                                                </td>
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
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b dark:border-gray-700">
                                                <td colspan="3"
                                                    class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
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
        var customHeaders = ["Name", "NAME", "PLATE", "MODEL", "TIMEIN", "TIMEOUT"];

        // Loop through the header cells of the original table
        for (var j = 1; j < table.rows[1].cells.length; j++) {
            // Check if the column index is in the list of columns you want to print
            if ([1, 2, 3, 4, 5].includes(j)) {
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
                if ([2, 0, 3, 4, 5].includes(j)) {
                    var cell = row.insertCell();
                    cell.innerHTML = table.rows[i].cells[j].innerHTML;
                    cell.style.width = "20%";
                }
            }
        }

        // Add a title to the printed output
        newWindow.document.write("<h1>FleetLink</h1>");
        newWindow.document.write(printTable.outerHTML);
        newWindow.document.write("</body></html>");
        newWindow.document.close();
        newWindow.print();
        newWindow.close();
    }

</script>
