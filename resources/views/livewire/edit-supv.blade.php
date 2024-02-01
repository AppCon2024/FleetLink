<div>
    <form action="">
        <div class="p-4 md:p-5 space-y-4">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900">Firstname</label>
                    <input wire:model="first_name" type="text" placeholder="Firstname"
                        class="bg-gray-100 border border-gray-300 text-gray-900">
                    @error('first_name')
                        <span class="block text-red-400 text-sm"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>

        <button wire:click.prevent="create" type="submit"
            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
    </form>
</div>
