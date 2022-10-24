@props(['title','description'])
<x-jet-section-title>
    <x-slot name="title" class=""><span class="dark:text-gray-300">{{ $title }}</span></x-slot>
    <x-slot name="description"><span class="dark:text-gray-400">{{ $description }}</span></x-slot>
</x-jet-section-title>
