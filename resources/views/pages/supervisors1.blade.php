<x-app-layout>
    <x-message />
    @include('includes.supervisor.menu')

    <!--Container-->
    <div
        class="relative top-[70px] md:w-[calc(100%-256px)] md:ml-64 xl:w-[80%] mx-auto px-2 p-5 rounded-lg bg-gray-100">
        <!--Card-->
        <div id='recipients' class="p-5 mt-5 lg:mt-0 rounded-2xl shadow bg-gray-200">
            <!--AlphineModal-->
            <div x-data="{ supervisorDelete: false, adminNewUsers: false, supervisorEdit: false, supervisorPreview: false, itemToDelete: null, itemToEdit: null, isPhoneNumber: false }">
                <button @click="adminNewUsers = true"
                    class="mb-2 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center"><i
                        class="ri-add-line mr-1 text-lg"></i>Add New Supervisor</button>
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            {{-- <th>Lastname</th>
                            <th>Firstname</th> --}}
                            <th>Name</th>
                            {{-- <th>EmployeeID</th>
                            <th>Email</th> --}}
                            <th>Department</th>
                            <th>Position</th>
                            {{-- <th>Phone #</th> --}}
                            <th>Actions</th>
                            {{-- <th>Action</th> --}}

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $supervisor)
                            <tr x-on:click="itemToEdit = {{ $supervisor->id }};">
                                <td class="text-center">{{ $supervisor->id }}</td>
                                <td class=" flex items-end justify-center">
                                    <img src="{{ asset($supervisor->photo) }}" width='30' height="30">
                                </td>
                                {{-- <td>{{ $supervisor->last_name }}</td>
                                <td>{{ $supervisor->first_name }}</td> --}}
                                <td>{{ $supervisor->name }}</td>
                                {{-- <td>{{ $supervisor->employee_id }}</td>
                                <td>{{ $supervisor->email }}</td> --}}
                                <td class="text-center">{{ $supervisor->department }}</td>
                                <td class="text-center">{{ $supervisor->position }}</td>
                                <td class="text-center">
                                    <button
                                    @click="supervisorEdit = true; itemToEdit = $event.target.getAttribute('data-item-id')"
                                    data-item-id="{{ $supervisor->id }}"
                                    class="hover:bg-sky-600 text-blue-500 hover:text-white px-4 py-2">
                                    <i class="ri-edit-fill"></i>
                                </button>

                                <button
                                    @click="supervisorDelete = true; itemToDelete = $event.target.getAttribute('data-item-id')"
                                    data-item-id="{{ $supervisor->id }}"
                                    class="hover:bg-red-600 text-red-500 hover:text-white px-4 py-2">
                                    <i class="ri-delete-bin-fill"></i>
                                </button>
                                </td>
                                {{-- <td>{{ $supervisor->phone }}</td> --}}
                                {{-- <td class="text-center ">
                                    <button
                                        @click="supervisorEdit = true; itemToEdit = $event.target.getAttribute('data-item-id')"
                                        data-item-id="{{ $supervisor->id }}"
                                        class= "text-blue-600 hover:bg-blue-600 hover:text-white px-3 py-1 rounded-xl">
                                        Edit
                                    </button>
                                    <button
                                        @click="supervisorDelete = true; itemToDelete = $event.target.getAttribute('data-item-id')"
                                        data-item-id="{{ $supervisor->id }}"
                                        class="text-red-600 hover:bg-red-600 hover:text-white px-3 py-1 rounded-xl">
                                        Delete
                                    </button>
                                </td> --}}
                                {{-- <td class="px-4 py-3 flex items-center justify-center">
                                    <button id="apple-imac-27-dropdown-button"
                                        data-dropdown-toggle="apple-imac-27-dropdown"
                                        class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <button
                                                    @click="supervisorEdit = true; itemToEdit = $event.target.getAttribute('data-item-id')"
                                                    data-item-id="{{ $supervisor->id }}"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    @click="supervisorPreview = true; itemToEdit = $event.target.getAttribute('data-item-id')"
                                                    data-item-id="{{ $supervisor->id }}"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                    Preview
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    @click="supervisorDelete = true; itemToDelete = $event.target.getAttribute('data-item-id')"
                                                    data-item-id="{{ $supervisor->id }}"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                                    <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            fill="currentColor"
                                                            d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Edit Modal -->
                <div x-show="supervisorEdit" class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20"
                    x-cloak>
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <div x-show="supervisorEdit" @click.away="supervisorEdit = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-xl sm:w-full">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                    class="ri-edit-2-fill mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                Edit User Information
                            </h3>
                        </div>
                        @foreach ($data as $supervisor)
                            <div x-show="itemToEdit === {{ $supervisor->id }}">
                                <form method="post" :action="`{{ route('supervisors.update', '') }}/${itemToEdit}`">
                                    @csrf
                                    @method('patch')

                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="flex justify-center">
                                            <img src="{{ asset($supervisor->photo) }}" width='150'
                                                height="150" class="mb-2 flex justify-center">
                                            <input class="form-control" name="photo" type="file"
                                                id="photo">
                                        </div>
                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">

                                            {{-- <div>
                                                <label for="UserID"
                                                    class="block mb-2 text-sm font-medium text-gray-900">UserID</label>
                                                <input type="text" name="id" value="{{ $item->id }}"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>
                                            <div>
                                                <label for="created_at"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Account
                                                    Created</label>
                                                <input type="text" name="created_at"
                                                    value="{{ $item->created_at }}"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div> --}}


                                            <div>
                                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Firstname</label>
                                                <input type="text" name="first_name"
                                                    value="{{ $supervisor->first_name }}"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2" required>
                                            </div>

                                            <div>
                                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Lastname:</label>
                                                <input type="text" name="last_name"
                                                    value="{{ $supervisor->last_name }}"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2" required>
                                            </div>

                                            <div>
                                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                                                <input type="text" name="email" value="{{ $supervisor->email }}"
                                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2" required>
                                            </div>

                                            <div>
                                                <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900">Employee ID</label>
                                                <input type="text" name="employee_id" value="{{ $supervisor->employee_id }}"
                                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2" required>
                                            </div>


                                            {{-- <div>
                                                <label for="phone">Phone Number</label>
                                                <input type="text" name="phone" value="{{ $item->phone }}"
                                                    class="bg-gray-100 border border-gray-600 text-gray-900" required>
                                            </div> --}}

                                            <div>
                                                <label for="department"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Department</label>
                                                    <select name="department" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2">
                                                        <option value="" {{$supervisor->department ==  "" ? 'selected' : ''}}></option>
                                                        <option value="Admin PNCO" {{$supervisor->department ==  "Admin PNCO" ? 'selected' : ''}}>Admin PNCO</option>
                                                        <option value="Operation PNCO" {{$supervisor->department ==  "Operation PNCO" ? 'selected' : ''}}>Operation PNCO</option>
                                                        <option value="Investigation PNCO" {{$supervisor->department ==  "Investigation PNCO" ? 'selected' : ''}}>Investigation PNCO</option>
                                                        <option value="Finance PNCO" {{$supervisor->department ==  "Finance PNCO" ? 'selected' : ''}}>Finance PNCO</option>
                                                        <option value="Logistics PNCO" {{$supervisor->department ==  "Logistics PNCO" ? 'selected' : ''}}>Logistics PNCO</option>
                                                        <option value="Police Clearance PNCO" {{$supervisor->department ==  "Police Clearance PNCO" ? 'selected' : ''}}>Police Clearance PNCO</option>
                                                        <option value="Intel PNCO" {{$supervisor->department ==  "Intel PNCO" ? 'selected' : ''}}>Intel PNCO</option>
                                                    </select>
                                                    @error('department')
                                                            <p class="text-red-500 text-xs p-1">
                                                                {{$message}}
                                                            </p>
                                                    @enderror
                                            </div>

                                            <div>
                                                <label for="position"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                                                    <select name="position" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white  mb-2">
                                                        <option value="" {{$supervisor->position ==  "" ? 'selected' : ''}}></option>
                                                        <option value="Police Captain Deputy" {{$supervisor->position ==  "Police Captain Deputy" ? 'selected' : ''}}>Police Captain Deputy</option>
                                                        <option value="Police Executive Master Sergeant" {{$supervisor->position ==  "Police Executive Master Sergeant" ? 'selected' : ''}}>Police Executive Master Sergeant</option>
                                                        <option value="Station's Support and Services Officer" {{$supervisor->position ==  "Station's Support and Services Officer" ? 'selected' : ''}}>Station's Support and Services Officer</option>
                                                        <option value="Police Lieutenant" {{$supervisor->position ==  "Police Lieutenant" ? 'selected' : ''}}>Police Lieutenant</option>
                                                        <option value="Police Chief Master Sergeant" {{$supervisor->position ==  "Police Chief Master Sergeant" ? 'selected' : ''}}>Police Chief Master Sergeant</option>
                                                        <option value="Police Master Sergeant" {{$supervisor->position ==  "Police Master Sergeant" ? 'selected' : ''}}>Police Master Sergeant</option>
                                                        <option value="Police Staff Sergeant" {{$supervisor->position ==  "Police Staff Sergeant" ? 'selected' : ''}}>Police Staff Sergeant</option>
                                                        <option value="Police Corporal" {{$supervisor->position ==  "Police Corporal" ? 'selected' : ''}}>Police Corporal</option>
                                                        <option value="Police Major" {{$supervisor->position ==  "Police Major" ? 'selected' : ''}}>Police Major</option>
                                                        <option value="Patrolman" {{$supervisor->position ==  "Patrolman" ? 'selected' : ''}}>Patrolman</option>
                                                        <option value="Patrolwoman" {{$supervisor->position ==  "Patrolwoman" ? 'selected' : ''}}>Patrolwoman</option>
                                                    </select>
                                                    @error('position')
                                                            <p class="text-red-500 text-xs p-1">
                                                                {{$message}}
                                                            </p>
                                                    @enderror
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
                                        <Button @click="supervisorEdit = false" type="button"
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

                <!--Preview-->
                <div x-show="supervisorPreview"
                    class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <div x-show="supervisorPreview" @click.away="supervisorPreview = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-3xl sm:w-full">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                    class="ri-user-fill mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                                User Information
                            </h3>
                        </div>
                        @foreach ($data as $item)
                            <div x-show="itemToEdit === {{ $item->id }}">
                                <form method="post" :action="`{{ route('supervisors.update', '') }}/${itemToEdit}`">
                                    @csrf
                                    @method('patch')

                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="grid gap-3 mb-4 sm:grid-cols-3 grid-flow-row-dense">
                                            <div>
                                                <img src="{{ asset($supervisor->photo) }}" width='150'
                                                    height="150" class="mb-2 flex justify-center">
                                            </div>
                                            <div>
                                                <label for="UserID"
                                                    class="block mb-2 text-sm font-medium text-gray-900">UserID</label>
                                                <input type="text" name="id" value="{{ $item->id }}"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>
                                            <div>
                                                <label for="created_at"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Account
                                                    Created</label>
                                                <input type="text" name="created_at"
                                                    value="{{ $item->created_at }}"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>
                                            <div>
                                                <label for="last_name"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Lastname</label>
                                                <input type="text" name="last_name"
                                                    value="{{ $item->last_name }}"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>

                                            <div>
                                                <label for="first_name"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Firstname</label>
                                                <input type="text" name="first_name"
                                                    value="{{ $item->first_name }}"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>

                                            <div>
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                                <input type="text" name="email" value="{{ $item->email }}"
                                                    class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>

                                            <div>
                                                <label for="phone" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Phone Number</label>
                                                <input type="text" name="phone" value="{{ $item->phone }}"
                                                class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>

                                            <div>
                                                <label for="role" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Role</label>
                                                <input type="text" name="role" value="{{ $item->role }}"
                                                class="bg-gray-100 border border-gray-300 text-gray-900" disabled>
                                            </div>

                                        </div>
                                    </div>

                                    <!--Buttons-->
                                    <div
                                        class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <Button @click="supervisorPreview = false" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                            Exit
                                        </Button>
                                    </div>
                                    <!--Buttons-->
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Delete Modal -->
                <div x-show="supervisorDelete"
                    class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <div x-show="supervisorDelete" @click.away="supervisorDelete = false"
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
                                <form method="post" :action="`{{ route('supervisor_delete', '') }}/${itemToDelete}`">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                        Delete
                                    </button>
                                </form>
                                <button @click="supervisorDelete = false"
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
                        class="bg-white rounded-lg overflow-hidden transform transition-all sm:max-w-xl sm:w-full">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900"><i
                                class="ri-add-line mr-1 text-lg bg-blue-200 p-4 rounded-full"></i>
                            Add New Supervisor
                        </h3>
                        </div>
                        <hr class="bg-black w-[410px]">
                        <form action="{{ route('supervisors.create_supervisor') }}" method="post"
                            enctype="multipart/form-data" class="pl-5 pr-5 pt-3">
                            @csrf
                            <div class="p-4 md:p-5 space-y-4">
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">

                                    <div>
                                        <label for="first_name"
                                            class="block mb-2 text-sm font-medium text-gray-900">Firstname :</label>
                                        <input type="text" name="first_name"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" required>
                                    </div>

                                    <div>
                                        <label for="last_name"
                                            class="block mb-2 text-sm font-medium text-gray-900">Lastname :</label>
                                        <input type="text" name="last_name"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" required>
                                    </div>

                                    <div>
                                        <label for="employee_id"
                                            class="block mb-2 text-sm font-medium text-gray-900">Employee ID :</label>
                                        <input type="text" name="employee_id"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" required>
                                    </div>

                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900">Email Address :</label>
                                        <input type="text" name="email"
                                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg"  required>
                                    </div>

                                    {{-- <div>
                                        <label for="phone"
                                            class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                                        <input type="tel" name="phone"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)"
                                            id="phone" data-default-country="ph"
                                            class="bg-gray-100 border border-gray-300 text-gray-900" required>
                                    </div> --}}

                                    <div>
                                        <label for="department"
                                            class="block mb-2 text-sm font-medium text-gray-900">Deparment :</label>
                                            <select name="department" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2">
                                                <option value="" {{old('department') ==  "" ? 'selected' : ''}}></option>
                                                <option value="Admin PNCO" {{old('department') ==  "Admin PNCO" ? 'selected' : ''}}>Admin PNCO</option>
                                                <option value="Operation PNCO" {{old('department') ==  "Operation PNCO" ? 'selected' : ''}}>Operation PNCO</option>
                                                <option value="Investigation PNCO" {{old('department') ==  "Investigation PNCO" ? 'selected' : ''}}>Investigation PNCO</option>
                                                <option value="Finance PNCO" {{old('department') ==  "Finance PNCO" ? 'selected' : ''}}>Finance PNCO</option>
                                                <option value="Logistics PNCO" {{old('department') ==  "Logistics PNCO" ? 'selected' : ''}}>Logistics PNCO</option>
                                                <option value="Police Clearance PNCO" {{old('department') ==  "Police Clearance PNCO" ? 'selected' : ''}}>Police Clearance PNCO</option>
                                                <option value="Intel PNCO" {{old('department') ==  "Intel PNCO" ? 'selected' : ''}}>Intel PNCO</option>
                                            </select>
                                            @error('department')
                                                    <p class="text-red-500 text-xs p-1">
                                                        {{$message}}
                                                    </p>
                                            @enderror
                                    </div>

                                    <div>
                                        <label for="position"
                                            class="block mb-2 text-sm font-medium text-gray-900">Position :</label>
                                            <select name="position" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white  mb-2">
                                                <option value="" {{old('position') ==  "" ? 'selected' : ''}}></option>
                                                <option value="Police Captain Deputy" {{old('position') ==  "Police Captain Deputy" ? 'selected' : ''}}>Police Captain Deputy</option>
                                                <option value="Police Executive Master Sergeant" {{old('position') ==  "Police Executive Master Sergeant" ? 'selected' : ''}}>Police Executive Master Sergeant</option>
                                                <option value="Station's Support and Services Officer" {{old('position') ==  "Station's Support and Services Officer" ? 'selected' : ''}}>Station's Support and Services Officer</option>
                                                <option value="Police Lieutenant" {{old('position') ==  "Police Lieutenant" ? 'selected' : ''}}>Police Lieutenant</option>
                                                <option value="Police Chief Master Sergeant" {{old('position') ==  "Police Chief Master Sergeant" ? 'selected' : ''}}>Police Chief Master Sergeant</option>
                                                <option value="Police Master Sergeant" {{old('position') ==  "Police Master Sergeant" ? 'selected' : ''}}>Police Master Sergeant</option>
                                                <option value="Police Staff Sergeant" {{old('position') ==  "Police Staff Sergeant" ? 'selected' : ''}}>Police Staff Sergeant</option>
                                                <option value="Police Corporal" {{old('position') ==  "Police Corporal" ? 'selected' : ''}}>Police Corporal</option>
                                                <option value="Police Major" {{old('position') ==  "Police Major" ? 'selected' : ''}}>Police Major</option>
                                                <option value="Patrolman" {{old('position') ==  "Patrolman" ? 'selected' : ''}}>Patrolman</option>
                                                <option value="Patrolwoman" {{old('position') ==  "Patrolwoman" ? 'selected' : ''}}>Patrolwoman</option>
                                            </select>
                                            @error('position')
                                                    <p class="text-red-500 text-xs p-1">
                                                        {{$message}}
                                                    </p>
                                            @enderror
                                    </div>

                                </div>


                                <div>
                                    <input class="form-control" name="photo" type="file" id="photo">
                                </div>
                            </div>
                            <!--BUTTONS-->
                            <div class="flex justify-end mt-3 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
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




    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

    <script>
        function deleteItem(itemId) {
            // Set the itemToDelete value based on the clicked item's ID
            this.itemToDelete = itemId;
        }

        window.addEventListener('DOMContentLoaded', () => {
            Alpine.data('yourComponentName', () => ({
                supervisorEdit: false,
                itemToEdit: null, // Variable to store the selected item
            }));
        });

        const input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        });
    </script>








    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
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

            $('#example').DataTable();

        });
    </script>

    {{-- <x-edit /> --}}
</x-app-layout>
