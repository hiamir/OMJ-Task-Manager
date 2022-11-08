<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data=" Main({
                darkMode: $persist(localStorage.getItem('dark')),
                }) "
      x-bind:class="{ 'dark': darkMode }"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OMJ task Manager') }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-jet-banner/>

<div class="flex flex-col min-h-screen bg-gray-white dark:bg-oblue-600 transition-all duration-300 ">
    {{$slot}}
</div>

@stack('modals')
@livewireScripts

</body>
</html>
