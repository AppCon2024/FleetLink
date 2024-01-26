<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="p-5">

        @include('includes.modal.try')

        <button x-data x-on:click="$dispatch('open-modal',{ name : 'test'})" class="px-3 py-1 bg-teal-500 text-white rounded">Modal 1</button>

        <button x-data x-on:click="$dispatch('open-modal',{ name : 'modal2'})" class="px-3 py-1 bg-teal-500 text-white rounded">Modal 2</button>

        <button x-data x-on:click="$dispatch('open-modal',{ name : 'modal3'})" class="px-3 py-1 bg-teal-500 text-white rounded">Modal 2</button>

        @livewire('register')

    </body>
</html>
