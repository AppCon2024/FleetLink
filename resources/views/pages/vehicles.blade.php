<x-app-layout>
    <x-message />


    @if (Auth::user()->role == 'admin')
        @include('includes.sidebar.vehicle')
        <livewire:vhcl />
    @endif


    @if (Auth::user()->role == 'supervisor')
        @include('includes.supv-sidebar.vehicle')
        <livewire:vhcl />
    @endif

</x-app-layout>
