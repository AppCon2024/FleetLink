@if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="bg-blue-200 fixed m-10 bottom-0 right-0 z-20 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md"
            role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-blue-700 mr-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    <p class="font-bold text-black">Alert Message</p>
                    <p class="text-sm text-black">{{ session('message') }}</p>
                </div>
            </div>
        </div>
@endif

    @if ($isOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white p-4 rounded-xl shadow-lg w-1/2 ">
                <!-- Modal content goes here -->
                <div class="flex items-center justify-between pb-2 md:pb-3 border-b border-gray-500">
                    <h2 class="pl-4 text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $postId ? 'Edit Vehicle Information' : 'Add a Vehicle' }}</h2>
                    <button wire:click.prevent="$set('isOpen', false)"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span></button>
                </div>

                <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}">

                    <div class="grid gap-3 mb-4 mt-4 sm:grid-cols-2 px-4">

                        <div>
                            <x-input-label for="plate" :value="__('Plate# :')" />
                            <x-text-input wire:model="plate" id="plate" class="block mt-1 w-full"
                                type="text" name="plate" :value="old('plate')" required autofocus
                                autocomplete="plate" />
                            <x-input-error :messages="$errors->get('plate')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="brand" :value="__('Brand :')" />
                            <x-text-input wire:model="brand" id="brand" class="block mt-1 w-full"
                                type="text" name="brand" :value="old('brand')" required autofocus
                                autocomplete="brand" />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="model" :value="__('Model :')" />
                            <x-text-input wire:model="model" id="model" class="block mt-1 w-full"
                                type="text" name="model" :value="old('model')" required
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="vin" :value="__('Vin# :')" />
                            <x-text-input wire:model="vin" id="vin" class="block mt-1 w-full"
                                type="text" name="vin" :value="old('vin')" required
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('vin')" class="mt-2" />
                        </div>

                    </div>

                    <!--Buttons-->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="mr-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ $postId ? 'Update' : 'Create' }}
                        </button>
                        <button type="button"
                            class= "text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            wire:click="closeModal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    @endif

    @if ($deleteOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white p-4 rounded-xl shadow-lg ">
                <!-- Modal content goes here -->
                    <button wire:click.prevent="$set('deleteOpen', false)" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <form wire:submit.prevent="remove">
                    <p class="mb-4 text-gray-500 dark:text-gray-300">
                        Are you sure you want to delete this Vehicle?
                    </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="deleteCloseModal" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </form>
                    </div>
            </div>
        </div>
    @endif

    @if ($qrOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white p-4 rounded-xl shadow-lg ">
            <!-- Modal content goes here -->
                <p>{{ $plate }}</p>
                <button wire:click.prevent="$set('qrOpen', false)" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <p class="ml-1 mb-2 text-gray-500 dark:text-gray-300">
                    <img src="{{ $qrcode }}">
                </p>
                <div class="flex justify-center items-center space-x-4">
                    <button wire:click="closeQrModal" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Yes, I'm sure
                    </button>
                </div>
        </div>
    </div>
    @endif
