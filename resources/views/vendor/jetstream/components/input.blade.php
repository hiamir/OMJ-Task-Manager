@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:!bg-oblue-400 appearance-none dark:!autofill:bg-oblue-400 focus:border-indigo-300 dark:border-olblue-800 focus:ring dark:text-olblue-300
focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}">
