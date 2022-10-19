<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
            darkMode: localStorage.getItem('dark') === 'true'
      }"
      x-init="$watch('darkMode', function(val){
        localStorage.setItem('dark', val);
        console.log(darkMode);
      })"
      x-bind:class="{ 'dark': darkMode }"

>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OMJ task Manager') }}</title>

    <!-- Fonts -->
{{--        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">--}}

<!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-jet-banner/>

<div class="flex flex-col min-h-screen bg-gray-100 dark:bg-oblue-600">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow dark:bg-oblue-400 ">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
@endif

<!-- Page Content -->
    <main class="h-full">
        {{ $slot }}
    </main>

    <footer class="p-4 mt-auto justify-between bg-white shadow md:px-6 md:py-8 dark:bg-oblue-700">
        <span class="block xs:text-xs md:text-sm text-gray-500 text-center dark:text-olblue-600 sm:text-center dark:text-gray-400">© 2022 <a
                href="https://www.omjournal.org"
                class="hover:underline">Oman Medical Journal™</a>. All Rights Reserved.
    </span>
    </footer>
</div>

@stack('modals')
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js" defer></script>
@livewireScripts

</body>
</html>
