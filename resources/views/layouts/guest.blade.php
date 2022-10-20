<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="Main()"
      x-bind:class="{ 'dark': darkMode }"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            input:-webkit-autofill,
            input:-webkit-autofill:focus {
                transition: background-color 600000s 0s, color 600000s 0s !important;
            }
        </style>
        <!-- Fonts -->
{{--        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">--}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="bg-gray-100 dark:bg-oblue-600 font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js" defer></script>
</html>
