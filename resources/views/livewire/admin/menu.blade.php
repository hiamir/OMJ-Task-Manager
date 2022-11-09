<div>
    @livewire('layout.navigation')
    @livewire('layout.toggle')
    @livewire('layout.sidebar')
    @livewire('layout.header',['header'=>$pageHeader])

    <!-- Page Content -->
    <x-layout.content>

<x-item.modal buttonName="Create" type="add" modalHeader="Create Menu"></x-item.modal>

    </x-layout.content>
</div>
