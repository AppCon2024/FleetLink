  <div class="flex flex-row items-center">
        <label class="w-40 text-sm font-medium text-gray-900 mr-1">User Account:</label>
        <select wire:model.live="status"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option value="">All</option>
            <option value="1">Enabled</option>
            <option value="0">Disabled</option>
        </select>
    </div>
