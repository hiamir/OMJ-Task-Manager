<div>
    @livewire('layout.navigation')
    @livewire('layout.toggle')
    @livewire('layout.sidebar')
    @livewire('layout.header',['header'=>$pageHeader])

    <!-- PAGE CONTENT -->
    <x-layout.content>
        <!-- Menu create -->
        <x-item.modal buttonName="{{$buttonName}}" size="small" type="{{$formType}}" modalHeader="{{$modalHeader}}">
            <x-item.form method="POST">
                <div class="grid grid-cols-1 gap-4">
                    <x-item.elements.input wireName="menuLevel.name" updating="defer" name="menu-name" label="Name"
                                           placeholder="Enter a name for menu Level"></x-item.elements.input>
                </div>
                <x-item.form-submit name="{{$submitName}}"></x-item.form-submit>
            </x-item.form>
        </x-item.modal>

        <!-- Menu datatable -->
        <div class="mt-3">
            <livewire:admin.menu.menu-level-table/>
        </div>
    </x-layout.content>


</div>
