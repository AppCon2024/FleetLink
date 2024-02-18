<x-app-layout>
    <!--AllFine-->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    @if (Auth::user()->role == 'admin')

        <div class="fixed left-3 top-[86px] w-[240px] h-[86%] bg-blue-200 rounded-3xl p-4">
            <ul class="mt-2">
                <li class="mb-1 group">
                    <a href="{{ asset('dashboard') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-[#4ECE5D] group-[.selected]:text-white">
                        <i class="ri-dashboard-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Dashboard</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('supervisors') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-[#4ECE5D] group-[.selected]:text-white">
                        <i class="ri-admin-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Supervisors</span>
                    </a>
                </li>
                <li class="mb-1 group active">
                    <a href="{{ asset('accounts') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-[#4ECE5D] group-[.selected]:text-white">
                        <i class="ri-account-pin-box-line mr-3 text-lg"></i>
                        <span class="font-poppins">Accounts</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('vehicles') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-[#4ECE5D] group-[.active]:text-white group-[.selected]:bg-[#4ECE5D] group-[.selected]:text-white">
                        <i class="ri-user-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Vehicles</span>
                    </a>
                </li>
            </ul>
        </div>



        <!--Container-->
        <div
            class="relative top-[70px] md:w-[calc(100%-256px)] md:ml-64 xl:w-[80%] mx-auto px-2 p-5 rounded-lg bg-gray-100">
            <!--Card-->
            <div id='recipients' class="p-5 mt-5 lg:mt-0 rounded-2xl shadow bg-gray-200">
                <!--AlphineModal-->
                <div x-data="{ accountDelete: false, adminNewUsers: false, accountEdit: false, itemToDelete: null, itemToEdit: null }">
                    <button @click="adminNewUsers = true"
                        class="mb-2 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center"><i
                            class="ri-add-line mr-1 text-lg"></i>Add New Account</button>
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                {{-- <th>Emergency Phone</th> --}}
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr x-on:click="itemToEdit = {{ $account->id }};">
                                    <td class="text-center">{{ $account->id }}</td>
                                    <td class="text-center">{{ $account->name }}</td>
                                    <td class="text-center">{{ $account->username }}</td>
                                    <td class="text-center">{{ $account->email }}</td>
                                    <td class="text-center">{{ $account->phone }}</td>
                                    {{-- <td class="text-center">{{ $account->shift }}</td>
                                    <td class="text-center">{{ $account->emergency_phone }}</td> --}}
                                    <td class="text-center ">
                                        <button
                                            @click="accountEdit = true; itemToEdit = $event.target.getAttribute('data-item-id')"
                                            data-item-id="{{ $account->id }}"
                                            class="bg-sky-600 text-white px-6 py-2 rounded-xl">
                                            Edit
                                        </button>
                                    </td>
                                    <td class="text-red-500 text-center">
                                        <button
                                            @click="accountDelete = true; itemToDelete = $event.target.getAttribute('data-item-id')"
                                            data-item-id="{{ $account->id }}"
                                            class="bg-red-600 text-white px-4 py-2 rounded-xl">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Edit Modal -->
                    <div x-show="accountEdit"
                        class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div x-show="accountEdit" @click.away="accountEdit = false"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                        class="ri-edit-2-fill mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                    Edit User Information
                                </h3>
                            </div>
                            @foreach ($accounts as $account)
                                <div x-show="itemToEdit === {{ $account->id }}">
                                    <form method="post" :action="`{{ route('accounts.update', '') }}/${itemToEdit}`">
                                        @csrf
                                        @method('patch')

                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div>
                                                    <label for="UserID"
                                                        class="block mb-2 text-sm font-medium text-gray-900">UserID</label>
                                                    <input type="text" name="id" value="{{ $account->id }}"
                                                        class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                                </div>
                                                <div>
                                                    <label for="created_at"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Account
                                                        Created</label>
                                                    <input type="text" name="created_at" value="{{ $account->created_at }}"
                                                        class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                                </div>
                                                <div>
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" value="{{ $account->name }}"
                                                        class="bg-gray-100 border border-gray-600 text-gray-900" required>
                                                </div>

                                                <div>
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" value="{{ $account->username }}"
                                                        class="bg-gray-100 border border-gray-600 text-gray-900" required>
                                                </div>

                                                <div>
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" value="{{ $account->email }}"
                                                        class="bg-gray-100 border border-gray-600 text-gray-900" required>
                                                </div>

                                                <div>
                                                    <label for="phone">Phone Number</label>
                                                    <input type="text" name="phone" value="{{ $account->phone }}"
                                                        class="bg-gray-100 border border-gray-600 text-gray-900" required>
                                                </div>

                                            </div>
                                        </div>

                                        <!--Buttons-->
                                        <div
                                            class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit"
                                                class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                Update
                                            </button>
                                            <Button @click="accountEdit = false" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Cancel
                                            </Button>
                                        </div>
                                        <!--Buttons-->
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Delete Modal -->
                    <div x-show="accountDelete"
                        class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <div x-show="accountDelete" @click.away="accountDelete = false"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                        class="ri-delete-bin-2-line mr-1 text-xl bg-red-300 p-4 rounded-full"></i>
                                    User Confirmation Needed
                                </h3>
                            </div>
                            <!-- ... (modal content) ... -->
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    Are you sure you want to delete this account?
                                </p>
                                <div
                                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <form method="post"
                                        :action="`{{ route('accounts.delete', '') }}/${itemToDelete}`">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                            Delete
                                        </button>
                                    </form>
                                    <button @click="accountDelete = false"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            <!--End of ModalContent-->
                        </div>
                    </div>


                    <!--AdminModal-->
                    <div x-show="adminNewUsers"
                        class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div x-show="adminNewUsers" @click.away="adminNewUsers = false"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900"><i
                                        class="ri-add-line mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                    Add New Account
                                </h3>
                            </div>
                            <hr class="bg-black w-[410px]">
                            <form action="{{ route('accounts.create_account') }}" method="post"
                                class="pl-5 pr-5 pt-3 pb-3">
                                @csrf
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <label for="created_at"
                                                class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                            <input type="text" name="name"
                                                class="bg-gray-100 border border-gray-300 text-gray-900" required>
                                        </div>

                                        <div>
                                            <label for="created_at"
                                                class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                            <input type="text" name="username"
                                                class="bg-gray-100 border border-gray-300 text-gray-900" required>
                                        </div>

                                        <div>
                                            <label for="created_at"
                                                class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                            <input type="text" name="email"
                                                class="bg-gray-100 border border-gray-300 text-gray-900" required>
                                        </div>

                                        <div>
                                            <label for="created_at"
                                                class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                                            <input type="text" name="phone"
                                                class="bg-gray-100 border border-gray-300 text-gray-900" required>
                                        </div>
                                        {{-- <div>
                                            <label for="emergency_phone"
                                                class="block mb-2 text-sm font-medium text-gray-900">Emergency Phone</label>
                                            <input type="text" name="emergency_phone"
                                                class="bg-gray-100 border border-gray-300 text-gray-900"
                                                required>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="flex justify-end mt-3">
                                    <button type="submit"
                                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        Create
                                    </button>
                            </form>
                            <div class="absolute mr-[90px]">
                                <button type="button" @click="adminNewUsers = false"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <script>
            function deleteItem(itemId) {
                // Set the itemToDelete value based on the clicked item's ID
                this.itemToDelete = itemId;
            }
        </script>

        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Alpine.data('yourComponentName', () => ({
                    supervisorEdit: false,
                    itemToEdit: null, // Variable to store the selected item
                }));
            });
        </script>


    @endif
















    @if (Auth::user()->role == 'supervisor')
        <div class="fixed left-3 top-[87px] w-[240px] h-[86%] bg-blue-200 rounded-3xl p-4">
            <ul class="mt-2">
                <li class="mb-1 group">
                    <a href="{{ asset('dashboard') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-dashboard-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Dashboard</span>
                    </a>
                </li>
                <li class="mb-1 group active">
                    <a href="{{ asset('accounts') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-admin-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Officer Accounts</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="{{ asset('tracking') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-account-pin-box-line mr-3 text-lg"></i>
                        <span class="font-poppins">Tracking</span>
                    </a>
                </li>
                {{-- <li class="mb-1 group">
                    <a href="{{ asset('calendar') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-user-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Calendar</span>
                    </a>
                </li> --}}
                <li class="mb-1 group">
                    <a href="{{ asset('messages') }}"
                        class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                        <i class="ri-calendar-2-fill mr-3 text-lg"></i>
                        <span class="font-poppins">Messages</span>
                    </a>
                </li>
            </ul>
        </div>


        <!--Container-->
        <div
            class="relative top-[70px] md:w-[calc(100%-256px)] md:ml-64 xl:w-[80%] mx-auto px-2 p-5 rounded-lg bg-gray-100">
            <!--Card-->
            <div id='recipients' class="p-5 mt-5 lg:mt-0 rounded-2xl shadow bg-gray-200">
                <!--AlphineModal-->
                <div x-data="{ accountDelete: false, adminNewUsers: false, accountEdit: false, itemToDelete: null, itemToEdit: null }">
                    <button @click="adminNewUsers = true"
                        class="mb-2 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center"><i
                            class="ri-add-line mr-1 text-lg"></i>Add New Account</button>
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                {{-- <th>Phone</th> --}}
                                <th>Email</th>
                                <th>Role</th>
                                {{-- <th>Emergency Phone</th> --}}
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr x-on:click="itemToEdit = {{ $account->id }};">
                                    <td class="text-center">{{ $account->id }}</td>
                                    <td class="text-center">{{ $account->name }}</td>
                                    <td class="text-center">{{ $account->email }}</td>
                                    <td class="text-center">{{ $account->role }}</td>
                                    {{-- <td class="text-center">{{ $account->shift }}</td>
                                    <td class="text-center">{{ $account->emergency_phone }}</td> --}}
                                    <td class="text-center ">
                                        <button
                                            @click="accountEdit = true; itemToEdit = $event.target.getAttribute('data-item-id')"
                                            data-item-id="{{ $account->id }}"
                                            class="bg-sky-600 text-white px-6 py-2 rounded-xl">
                                            Edit
                                        </button>
                                    </td>
                                    <td class="text-red-500 text-center">
                                        <button
                                            @click="accountDelete = true; itemToDelete = $event.target.getAttribute('data-item-id')"
                                            data-item-id="{{ $account->id }}"
                                            class="bg-[#2c50f1] text-white px-4 py-2 rounded-xl">
                                            Send SMS
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Edit Modal -->
                    <div x-show="accountEdit"
                        class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div x-show="accountEdit" @click.away="accountEdit = false"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                        class="ri-edit-2-fill mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                    Edit User Information
                                </h3>
                            </div>
                            @foreach ($accounts as $account)
                                <div x-show="itemToEdit === {{ $account->id }}">
                                    <form method="post" :action="`{{ route('accounts.update', '') }}/${itemToEdit}`">
                                        @csrf
                                        @method('patch')

                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div>
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                                    <input type="text" name="name" value="{{ $account->name }}"
                                                        class="bg-gray-100 border border-gray-300 text-gray-900"
                                                        required>
                                                </div>
                                                <div>
                                                    <label for="email"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                                    <input type="text" name="email" value="{{ $account->email }}"
                                                        class="bg-gray-100 border border-gray-300 text-gray-900"
                                                        required>
                                                </div>
                                                <div>
                                                    <label for="role"
                                                        class="block mb-2 text-sm font-medium text-gray-900">role</label>
                                                    <input type="text" name="role" value="{{ $account->role }}"
                                                        class="bg-gray-100 border border-gray-300 text-gray-900"
                                                        required>
                                                </div>
                                                {{-- <div>
                                                    <label for="emergency_phone"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Emergency Phone</label>
                                                    <input type="text" name="emergency_phone" value="{{ $account->emergency_phone }}"
                                                        class="bg-gray-100 border border-gray-300 text-gray-900"
                                                        required>
                                                </div> --}}

                                            </div>
                                        </div>

                                        <!--Buttons-->
                                        <div
                                            class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit"
                                                class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                Update
                                            </button>
                                            <Button @click="accountEdit = false" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Cancel
                                            </Button>
                                        </div>
                                        <!--Buttons-->
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Delete Modal -->
                    <div x-show="accountDelete"
                        class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <div x-show="accountDelete" @click.away="accountDelete = false"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                        class="ri-mail-send-fill mr-1 text-xl bg-[#9daae4] p-4 rounded-full"></i>
                                    Send Message to (Officer)
                                </h3>
                            </div>
                            <!-- ... (modal content) ... -->
                            <div class="p-4 md:p-5 space-y-4">
                                <textarea class="resize-y rounded-md sm:max-w-lg sm:w-full" placeholder="Place your message here"></textarea>

                                <!--Footer-->
                                <div
                                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <form method="post"
                                        :action="`{{ route('accounts.delete', '') }}/${itemToDelete}`">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                            Send
                                        </button>
                                    </form>
                                    <button @click="accountDelete = false"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            <!--End of ModalContent-->
                        </div>
                    </div>


                    <!--AdminModal-->
                    <div x-show="adminNewUsers"
                        class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div x-show="adminNewUsers" @click.away="adminNewUsers = false"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900"><i
                                        class="ri-add-line mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                    Add New Account
                                </h3>
                            </div>
                            <hr class="bg-black w-[410px]">
                            <form action="{{ route('accounts.create_account') }}" method="post"
                                class="pl-5 pr-5 pt-3 pb-3">
                                @csrf
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                            <input type="text" name="name"
                                                class="bg-gray-100 border border-gray-300 text-gray-900"
                                                required>
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900">email</label>
                                            <input type="text" name="email"
                                                class="bg-gray-100 border border-gray-300 text-gray-900"
                                                required>
                                        </div>
                                        <div>
                                            <label for="role"
                                                class="block mb-2 text-sm font-medium text-gray-900">role</label>
                                            <input type="text" name="role"
                                                class="bg-gray-100 border border-gray-300 text-gray-900"
                                                required>
                                        </div>
                                        {{-- <div>
                                            <label for="emergency_phone"
                                                class="block mb-2 text-sm font-medium text-gray-900">Emergency Phone</label>
                                            <input type="text" name="emergency_phone"
                                                class="bg-gray-100 border border-gray-300 text-gray-900"
                                                required>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="flex justify-end mt-3">
                                    <button type="submit"
                                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        Create
                                    </button>
                            </form>
                            <div class="absolute mr-[90px]">
                                <button type="button" @click="adminNewUsers = false"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="flex">
            <aside class="bg-white p-2 md:w-1/4 h-screen top-0 left-0 overflow-y-auto border-r border-gray-200">
                <nav>
                  <!-- Navigation links for larger screens -->
                  <ul class="mt-8">
                    <li>  <a href="#" class="text-blue-500 flex items-center py-2">
                        <i class="fas fa-inbox mr-2"></i> <!-- Inbox icon -->
                        Inbox
                      </a></li>
                    <li> <a href="#" class="text-blue-500 flex items-center py-2">
                        <i class="fas fa-map-marker-alt mr-2"></i> <!-- Maps icon -->
                        Maps
                      </a></li>
                    <li> <a href="#" class="text-blue-500 flex items-center py-2">
                        <i class="fas fa-comments mr-2"></i> <!-- Chat icon -->
                        Chats
                      </a></li>
                      <li>
                        <a href="#" class="text-blue-500 flex items-center py-2">
                          <i class="fas fa-cog mr-2"></i> <!-- Settings icon -->
                          Settings
                        </a>
                      </li>
                  </ul>
                </nav>
              </aside>


            <!-- Left side content -->
            <main class="p-5 md:w-3/4 min-h-screen">
                <div class="flex items-center justify-center">
                    <div class="flex bg-white text-white rounded-2xl items-center">
                        <div class="flex justify-around items-center py-2" id="iconContainer">
                            <!-- Icons for the first layer -->
                            <!-- Icon 1 -->
                            <div class="ml-6 flex flex-col items-center">
                              <img src="{{ asset('images/telephone.png') }}" alt="Your Image" class="w-10 h-auto rounded-lg">
                              <span style="font-size: 0.75rem;" class="text-black font-bold mt-1">Voice Call</span>
                          </div>

                          <!-- Icon 2 -->
                          <div class="ml-6 flex flex-col items-center">
                              <img src="{{ asset('images/comment.png') }}" alt="Your Image" class="w-10 h-auto rounded-lg">
                              <span style="font-size: 0.75rem;" class="text-black font-bold mt-1">Send SMS</span>
                          </div>
                          <!-- Icon 3 -->
                          <div id="qrButton" class="ml-6 mr-6 flex flex-col items-center">
                              <img src="{{ asset('images/qr (1).png') }}" alt="Your Image" class="w-10 h-auto rounded-lg">
                              <span style="font-size: 0.75rem;" class="text-black font-bold mt-1">Scan QR Code</span>
                          </div>
                        </a>
                    </div>
                </div>
              </div>

            <!-- Search bar -->
            <div class="flex items-center justify-center mt-0 relative p-4 ">
              <input
                type="text"
                placeholder="Search..."
                class="w-full px-5 py-2 rounded-3xl border-gray-300   "
              />
              <button
              type="button"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-blue-500 group-hover:bg-blue-300 px-2 py-2 rounded-full "
            >
            <span class="bg-blue-600 rounded-full p-2">
                <i class="fas fa-search text-white"></i>
              </span>

            </button>


            </div>

          </main>

       <!-- Sidebar for larger screens -->

  <nav id="mobileMenu" class="hidden md:hidden fixed bottom-0 w-full bg-blue-200">
    <div class="flex flex-col">
        <!-- First layer of icons -->
        <div class="flex justify-around items-center py-2">
            <!-- Icons for the first layer -->
            <!-- Icon 1 -->
            <div class="text-blue-500 flex flex-col items-center p-2">
                <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                    <i class="fas fa-inbox text-blue-600" ></i>
                </div>
                <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Inbox</span>
            </div>
            <!-- Icon 2 -->
            <div class="text-blue-500 flex flex-col items-center p-2">
                <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-blue-600" ></i>
                </div>
                <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">QR</span>
            </div>
            <!-- Icon 3 -->
            <div class="text-blue-500 flex flex-col items-center p-2">
                <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                    <i class="fas fa-comments text-blue-600" ></i>
                </div>
                <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Chats</span>
            </div>
            <!-- Icon 4 -->
            <div class="text-blue-500 flex flex-col items-center p-2">
              <div class="rounded bg-white bg-opacity-50 backdrop-blur-md m-2 w-6 h-6 flex items-center justify-center">
                  <i class="fas fa-cog text-blue-600" ></i>
              </div>
              <span style="font-size: 0.75rem; margin-top: -0.4rem;" class="text-black font-bold">Setting</span>
            </div>
        </div>
    </div>
</nav>

        <script>
            function deleteItem(itemId) {
                // Set the itemToDelete value based on the clicked item's ID
                this.itemToDelete = itemId;
            }
        </script>

        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Alpine.data('yourComponentName', () => ({
                    supervisorEdit: false,
                    itemToEdit: null, // Variable to store the selected item
                }));
            });
        </script>

    @endif
    <!-- jQuery -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {

            var table = $('#example').DataTable({

                    lengthMenu: [
                        [5, 10, 25, 50, 100, -1],
                        [5, 10, 25, 50, 100, 'All']
                    ]

                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>

</x-app-layout>
