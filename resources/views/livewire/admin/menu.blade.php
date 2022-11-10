<div>
    @livewire('layout.navigation')
    @livewire('layout.toggle')
    @livewire('layout.sidebar')
    @livewire('layout.header',['header'=>$pageHeader])

    <!-- PAGE CONTENT -->
    <x-layout.content>
        <!-- Menu create -->
        <x-item.modal buttonName="Create" size="small" type="add" modalHeader="Create Menu Level">
            <x-item.form method="POST">

                <div class="grid grid-cols-1 gap-4">


                  <x-item.elements.input wireName="menu.name" name="menu-name" label="Name" placeholder="Enter a name for menu item" ></x-item.elements.input>
                </div>

                <x-item.form-submit name="Add"></x-item.form-submit>
            </x-item.form>
        </x-item.modal>
    </x-layout.content>
</div>