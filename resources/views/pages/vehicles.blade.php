<x-app-layout>
    <x-message />

    @if (Auth::user()->role == 'admin')
        <div>
            <div class="w-auto px-3 overflow-auto">
                <div class="flex overflow-auto">
                    <div class="pr-3 hidden sm:block">
                        @include('includes.sidebar.vehicle')
                    </div>
                    <div class="flex-1">
                        <livewire:vhcl />
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if (Auth::user()->role == 'supervisor')
    <div>
        <div class="w-auto px-3 overflow-auto">
            <div class="flex overflow-auto">
                <div class="pr-3 hidden sm:block">
                    @include('includes.sidebar.vehicle')
                </div>
                <div class="flex-1">
                    <livewire:vhcl />
                </div>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>
