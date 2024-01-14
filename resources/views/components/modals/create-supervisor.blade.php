
<div
    x-data="{create-supervisor : false}"
    x-show="create-supervisor"
    x-on:create-supervisor.window = "create-supervisor : true"
    class="fixed inset-0 overflow-y-auto flex items-center justify-center z-20" x-cloak>
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show="create-supervisor"
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
                Add New Supervisor
            </h3>
        </div>
        <hr class="bg-black w-[410px]">
        <form action="{{ route('supervisors.create_supervisor') }}" method="post" enctype="multipart/form-data"
            class="pl-5 pr-5 pt-3 pb-3">
            @csrf
            <div class="p-4 md:p-5 space-y-4">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Lastname</label>
                        <input type="text" name="last_name"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                            class="bg-gray-100 border border-gray-300 text-gray-900" required>
                    </div>

                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Firstname</label>
                        <input type="text" name="first_name"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                            class="bg-gray-100 border border-gray-300 text-gray-900" required>
                    </div>

                    <div>
                        <label for="employee_id"
                            class="block mb-2 text-sm font-medium text-gray-900">employee_id</label>
                        <input type="text" name="employee_id"
                            class="bg-gray-100 border border-gray-300 text-gray-900" required>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="text" name="email" class="bg-gray-100 border border-gray-300 text-gray-900"
                            required>
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                        <input type="tel" name="phone"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)" id="phone"
                            data-default-country="ph" class="bg-gray-100 border border-gray-300 text-gray-900" required>
                    </div>

                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900">Deparment</label>
                        <select name="department"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-2">
                            <option value="" {{ old('department') == '' ? 'selected' : '' }}></option>
                            <option value="Admin PNCO" {{ old('department') == 'Admin PNCO' ? 'selected' : '' }}>Admin
                                PNCO</option>
                            <option value="Operation PNCO"
                                {{ old('department') == 'Operation PNCO' ? 'selected' : '' }}>Operation PNCO</option>
                            <option value="Investigation PNCO"
                                {{ old('department') == 'Investigation PNCO' ? 'selected' : '' }}>Investigation PNCO
                            </option>
                            <option value="Finance PNCO" {{ old('department') == 'Finance PNCO' ? 'selected' : '' }}>
                                Finance PNCO</option>
                            <option value="Logistics PNCO"
                                {{ old('department') == 'Logistics PNCO' ? 'selected' : '' }}>Logistics PNCO</option>
                            <option value="Police Clearance PNCO"
                                {{ old('department') == 'Police Clearance PNCO' ? 'selected' : '' }}>Police Clearance
                                PNCO</option>
                            <option value="Intel PNCO" {{ old('department') == 'Intel PNCO' ? 'selected' : '' }}>Intel
                                PNCO</option>
                        </select>
                        @error('department')
                            <p class="text-red-500 text-xs p-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                        <select name="position"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white  mb-2">
                            <option value="" {{ old('position') == '' ? 'selected' : '' }}></option>
                            <option value="Police Captain Deputy"
                                {{ old('position') == 'Police Captain Deputy' ? 'selected' : '' }}>Police Captain
                                Deputy</option>
                            <option value="Police Executive Master Sergeant"
                                {{ old('position') == 'Police Executive Master Sergeant' ? 'selected' : '' }}>Police
                                Executive Master Sergeant</option>
                            <option value="Station's Support and Services Officer"
                                {{ old('position') == "Station's Support and Services Officer" ? 'selected' : '' }}>
                                Station's Support and Services Officer</option>
                            <option value="Police Lieutenant"
                                {{ old('position') == 'Police Lieutenant' ? 'selected' : '' }}>Police Lieutenant
                            </option>
                            <option value="Police Chief Master Sergeant"
                                {{ old('position') == 'Police Chief Master Sergeant' ? 'selected' : '' }}>Police Chief
                                Master Sergeant</option>
                            <option value="Police Master Sergeant"
                                {{ old('position') == 'Police Master Sergeant' ? 'selected' : '' }}>Police Master
                                Sergeant</option>
                            <option value="Police Staff Sergeant"
                                {{ old('position') == 'Police Staff Sergeant' ? 'selected' : '' }}>Police Staff
                                Sergeant</option>
                            <option value="Police Corporal"
                                {{ old('position') == 'Police Corporal' ? 'selected' : '' }}>Police Corporal</option>
                            <option value="Police Major" {{ old('position') == 'Police Major' ? 'selected' : '' }}>
                                Police Major</option>
                            <option value="Patrolman" {{ old('position') == 'Patrolman' ? 'selected' : '' }}>Patrolman
                            </option>
                            <option value="Patrolwoman" {{ old('position') == 'Patrolwoman' ? 'selected' : '' }}>
                                Patrolwoman</option>
                        </select>
                        @error('position')
                            <p class="text-red-500 text-xs p-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                <div>
                    <input class="form-control" name="photo" type="file" id="photo">
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
