<x-layout.main pageHeader="{{$pageHeader}}">

    <!-- PAGE CONTENT -->
    <x-layout.content>
        <!-- Menu create -->

        <x-item.button wire:click.prevent="createMenu" size="small" class="!block w-auto">
            <x-svg.add class="flex w-4 h-4"></x-svg.add>
            <span class="flex ml-1">{{__('Create')}}</span>
        </x-item.button>

        <x-item.modal size="small" type="{{$formType}}" modalHeader="{{$modalHeader}}">
            <x-item.form method="POST">
                @if($formType === 'create' || $formType === 'update')
                    <div class="grid grid-cols-1 gap-4">
                        <x-item.elements.input wireName="menu.name" updating="defer" name="menu-name" label="Name"
                                               placeholder="Enter a name for menu "></x-item.elements.input>
                        <x-item.elements.select wireName="menu.menuID" name="menu-menuID" label="Belongs to"
                                                :data=$parentData
                                                placeholder=""></x-item.elements.select>
                    </div>


                    {{--                    <x-item.select name="sel" placeholder="fgdfgdf" :data=$parentData></x-item.select>--}}

                @endif

                @if($formType === 'delete' )
                    <div class="grid grid-cols-1 gap-4">
                        <p class="text-gray-900 dark:text-white"> Are you sure you want to delete <span
                                class="font-bold text-red-600">{{$menuRecord->name}}</span> ?</p>
                    </div>
                @endif
                <x-item.form-submit formType="{{$formType}}" type="submit" name="{{$submitName}}"></x-item.form-submit>
            </x-item.form>
        </x-item.modal>

        <!-- Menu datatable -->
        <div class="flex  justify-center items-center w-full mt-3">

            <div class="flex flex-row flex-wrap w-full  justify-center"

            >
                @foreach($menus as $menu)
                    <div
                        class="flex flex-col w-72 mx-[10px] my-[10px] shadow-md bg-white border shadow-sm rounded-xl dark:bg-oblue-300 dark:border-gray-700 dark:border-oblue-100/[0.5]">
                        <div class="class=flex flex-col bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-oblue-100 dark:border-olblue-800/[0.5]">
                            <div class="flex items-center">
                                <x-svg.security class="flex !w-5 !h-5 dark:text-olblue-300 mr-2"></x-svg.security>
                                <p class="flex  flex-grow mt-1 text-md text-gray-500 dark:text-olblue-300 font-bold capitalize">
                                    {{$menu->name}}
                                </p>
                            <div wire:click="deleteMenu({{$menu}})" class="transition-all duration-300 cursor-pointer  group hover:bg-red-600 hover:text-white hover:border-red-400 dark:hover:border-red-500  dark:hover:bg-red-700 flex w-8 h-8 border rounded-md border-gray-300 dark:border-olblue-800/[0.5] justify-center items-center">
                                <x-svg.close class=" !w-3 !h-3 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.close>
                            </div>
                            </div>
                        </div>
                        <div class="p-4 md:p-5">

                            <div wire:click.prevent="createMenu({{$menu->id}})" class="transition-all duration-300 cursor-pointer  group hover:bg-red-600 hover:text-white hover:border-red-400 dark:hover:border-red-500  dark:hover:bg-red-700 flex w-8 h-8 border rounded-md border-gray-300 dark:border-olblue-800/[0.5] justify-center items-center">
                                <x-svg.add class=" !w-4 !h-4 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.add>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{--            <livewire:admin.menu.menu-parent-datatable/>--}}
        </div>
    </x-layout.content>

</x-layout.main>
