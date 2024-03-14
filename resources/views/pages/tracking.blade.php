<x-app-layout>
    <div>
        <div class="w-auto px-3 overflow-auto">
            <div class="flex overflow-auto">
                <div class="pr-3 hidden sm:block">
                    @include('includes.supv-sidebar.tracking')
                </div>
                <div class="flex-1">
                    <livewire:supv />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
