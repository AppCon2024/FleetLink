<div>
    <form action="">
        <div class="p-4 md:p-5 space-y-4">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Name</label>
                    <input wire:model="name" type="text" placeholder="Name"
                        class="bg-gray-100 border border-gray-300 text-gray-900">
                        @error('name')
                            <span class="block text-red-400 text-sm"> {{ $message }} </span>
                        @enderror
                </div>
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                    <input wire:model="email" type="email" placeholder="Email Address"
                        class="bg-gray-100 border border-gray-300 text-gray-900">
                        @error('email')
                        <span class="block text-red-400 text-sm"> {{ $message }} </span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                    <input wire:model="password" type="password" placeholder="Password"
                        class="bg-gray-100 border border-gray-300 text-gray-900">
                        @error('password')
                        <span class="block text-red-400 text-sm"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>

        <button wire:click.prevent="create" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create</button>
    </form>

    @foreach ($users as $user)
        <h3> {{ $user->name }} </h3>
    @endforeach
</div>
