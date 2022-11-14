<x-layout.main pageHeader="{{$pageHeader}}">

    <!-- PAGE CONTENT -->
    <x-layout.content>
        <!-- Menu create -->

        <x-item.button wire:click.prevent="createMenu" size="small" class="!block w-auto">
                <x-svg.add class="flex w-4 h-4"></x-svg.add> <span class="flex ml-1">{{__('Create')}}</span>
        </x-item.button>

        <x-item.modal size="small" type="{{$formType}}" modalHeader="{{$modalHeader}}">
            <x-item.form method="POST">
                @if($formType === 'create' || $formType === 'update')
                    <div class="grid grid-cols-1 gap-4">
                        <x-item.elements.input wireName="menu.name" updating="defer" name="menu-name" label="Name"
                                               placeholder="Enter a name for menu "></x-item.elements.input>
                    </div>
                @endif

                    @if($formType === 'delete' )
                        <div class="grid grid-cols-1 gap-4">
                         <p class="text-gray-900 dark:text-white"> Are you sure you want to delete <span class="font-bold text-red-600">{{$menuRecord->name}}</span> ?</p>
                        </div>
                    @endif
                <x-item.form-submit formType="{{$formType}}" type="submit" name="{{$submitName}}"></x-item.form-submit>
            </x-item.form>
        </x-item.modal>

        <!-- Menu datatable -->
        <div class="mt-3">
            <livewire:admin.menu.menu-parent-datatable/>
        </div>
    </x-layout.content>

</x-layout.main>
