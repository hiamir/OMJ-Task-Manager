<div>
    @livewire('layout.navigation')
    @livewire('layout.toggle')
    @livewire('layout.sidebar')
    @livewire('layout.header',['header'=>$pageHeader])

    <!-- Page Content -->
    <x-layout.content>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl p-4 md:p-5 dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-900/[.9] dark:text-gray-400">
            Some quick example text to build on the card title and make up the bulk of the card's content.
        </div>
    </x-layout.content>

</div>
