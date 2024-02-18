<x-app-layout>
<x-message />
    @if (Auth::user()->role == 'admin')

    @include('includes.sidebar.officer')
        <livewire:ofcr />

    @endif


    @if (Auth::user()->role == 'supervisor')
        @include('includes.supv-sidebar.officer')

        <livewire:ofcr />
        @endif

</x-app-layout>
