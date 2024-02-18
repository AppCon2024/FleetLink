<x-app-layout>
    <x-message />

    @if (Auth::user()->role == 'admin')
   @include('includes.sidebar.status')

   <livewire:status />
    @endif

    @if (Auth::user()->role == 'supervisor')
    @include('includes.supv-sidebar.status')
    <livewire:status />
    @endif

</x-app-layout>
