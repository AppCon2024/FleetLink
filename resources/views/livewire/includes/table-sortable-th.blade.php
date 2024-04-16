<th scope="col" class="px-4 py-3" wire:click="setSortBy('{{ $tablesadb }}')">
    <button class="flex items-center text-xs text-gray-700 uppercase bg-gray-200">
        {{ $displayName }}
        @if ($sortBy !== $tablesadb)
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                stroke="blue" class="ml-1 w-3 h-3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
            </svg>
        @elseif ($sortDir === 'ASC')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                stroke="blue" class="ml-1 w-3 h-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                stroke="blue" class="ml-1 w-3 h-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>
        @endif
    </button>
</th>
