@props(['name', 'title'])
<div x-data = "{show : false , name : '{{ $name }}'}"
    x-show = "show"
    x-on:open-modal.window ="show = ($event.detail.name === name)"
    x-on:close-modal.window ="show = false"
    x-on:keydown.escape.window = "show = false"
    style="display:none;"
    class="fixed z-50 inset-0">
    <!--Gray Background-->
    <div x-on:click="show = false" class="fixed inset-0 bg-gray-800 opacity-40"></div>
    <!--Modal Body-->
    <div class="fixed inset-0 overflow-y-auto flex items-center justify-center">
        <div>
            {{ $body }}
        </div>

    </div>


</div>
