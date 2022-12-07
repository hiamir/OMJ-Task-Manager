<x-layout.main pageHeader="{{$pageHeader}}">

    <!-- PAGE CONTENT -->
    <x-layout.content>
        <!-- Menu create -->

        <x-item.button wire:click.prevent="show('create')" size="small"
                       class="!block w-auto dark:bg-green-700 dark:hover:bg-green-800 ">
            <x-svg.add class="flex w-4 h-4 dark:text-gray-200 dark:hover:text-white"></x-svg.add>
            <span class="flex ml-1 dark:text-gray-200 dark:hover:text-white">{{__('Create')}}</span>
        </x-item.button>

        <x-item.modal size="small" type="{{$formType}}" modalHeader="{{$modalHeader}}">
            <x-item.form method="POST">
                @if($formType === 'create' || $formType === 'update')
                    <div class="grid grid-cols-1 gap-4">

                        <x-item.elements.input wireName="permission.name" updating="defer" name="permission-name" label="Name"
                                               placeholder="Enter a permission name"></x-item.elements.input>

                        <x-item.elements.select wireName="permission.model" name="permission-model" label="Model"
                                                :data=$models
                                                placeholder=""></x-item.elements.select>

                        <x-item.elements.select wireName="permission.guard_name" name="permission-guards_name" label="Guard"
                                                :data=$guards
                                                placeholder=""></x-item.elements.select>
                    </div>
                @endif

                @if($formType === 'delete' )
                    <div class="grid grid-cols-1 gap-4">
                        <p class="text-gray-900 dark:text-white text-center"><span class="font-bold mb-2 text-red-600">WARNING!</span>
                            <br> Are you sure you want to delete this permission?</p>
                    </div>
                @endif
                <x-item.form-submit formType="{{$formType}}" type="submit" name="{{$submitName}}"></x-item.form-submit>
            </x-item.form>
        </x-item.modal>
<div class="mt-5">
        <livewire:admin.permissions.permissions-datatable />
</div>
    </x-layout.content>
</x-layout.main>
