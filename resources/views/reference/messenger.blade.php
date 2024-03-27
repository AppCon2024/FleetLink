<x-app-layout>

    <x-message />

<div class="fixed left-3 top-[87px] w-[240px] h-[86%] bg-blue-200 rounded-3xl p-4">
    <ul class="mt-2">
        <li class="mb-1 group">
            <a href="{{ asset('dashboard') }}"
                class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                <i class="ri-dashboard-fill mr-3 text-lg"></i>
                <span class="font-poppins">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ asset('accounts') }}"
                class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                <i class="ri-admin-fill mr-3 text-lg"></i>
                <span class="font-poppins">Officers</span>
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
        <li class="mb-1 group active">
            <a href="{{ asset('messages') }}"
                class="flex items-center py-2 px-4 text-black hover:bg-blue-400 hover:text-gray-100 rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-500 group-[.selected]:text-white">
                <i class="ri-calendar-2-fill mr-3 text-lg"></i>
                <span class="font-poppins">Messages</span>
            </a>
        </li>
    </ul>
</div>


</x-app-layout>
