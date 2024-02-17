<div class="flex space-x-3">
    <div class="flex space-x-3 items-center">
        <label class="w-40 text-sm font-medium text-gray-900">User Status :</label>
        <select wire:model="status"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option value="">All</option>
            <option value="0">Online</option>
            <option value="1">Offline</option>
        </select>
    </div>
    <button wire:click="create"
        class=" text-white border border-gray-300 bg-blue-500 uppercase rounded-lg text-xs p-2  text-center"><i
            class="ri-add-line text-sm"></i>
        Add Supervisor
    </button>
    <button
        class="text-white border border-gray-300 bg-gray-900 uppercase rounded-lg text-xs p-2  text-center">
        Export
    </button>
</div>