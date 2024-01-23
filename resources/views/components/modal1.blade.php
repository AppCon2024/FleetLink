@props(['name','title'])
<div
    x-data = "{show : false , name : '{{ $name }}'}"
    x-show = "show"
    x-on:open-modal.window ="show = ($event.detail.name === name)"
    x-on:close-modal.window ="show = false"
    x-on:keydown.escape.window = "show = false"
    style="display:none;"
    class="fixed z-50 inset-0"
    x-transition
    >
    <!--Gray Background-->
    <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-40"></div>
    <!--Modal Body-->
    <div class="bg-white rounded-xl m-auto fixed inset-0 max-w-2xl" style="max-height:500px">
        <button x-on:click="$dispatch('close-modal')">x</button>
        @if(isset($title))
        <div class="py-3 flex item-center justify-center">
            {{ $title ?? ''}}
        </div>
        @endif
        <div>
            {{$body}}
        </div>

    </div>


</div>
