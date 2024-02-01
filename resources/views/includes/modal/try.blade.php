<x-modal1 name="modal2" title="Modal 2">
    <x-slot:body>
        @livewire('register')
    </x-slot>
</x-modal1>
<x-modal1 name="test" title="Modal 1">
    <x-slot:body>
        <span class="p-5">Test Modal</span>
    </x-slot>
</x-modal1>
<x-modal1 name="modal3" title="Modal 3">
    <x-slot:body>
        @livewire('qrcode')
    </x-slot>
</x-modal1>
<x-modal1 name="qrcode" title="Modal 3">
    <x-slot:body>
        @livewire('qrcode')
    </x-slot>
</x-modal1>


