<x-app-layout>
    <x-message />
    @include('includes.modal.try')
    @include('includes.supervisor.menu')

    <!--Container-->

    @livewire('supv')

</x-app-layout>
