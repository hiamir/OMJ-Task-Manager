@props(['pageHeader'])
<div x-data=" Wire($wire,{ }) " class="flex h-full flex-col flex-grow min-h-screen">
    @livewire('layout.navigation')
    @livewire('layout.toggle')
    @livewire('layout.sidebar')
    @livewire('layout.header',['header'=>$pageHeader])
    {{$slot}}
    @livewire('layout.footer')
</div>
