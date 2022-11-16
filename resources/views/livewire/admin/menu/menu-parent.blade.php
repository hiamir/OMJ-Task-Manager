<x-layout.main pageHeader="{{$pageHeader}}">

    <!-- PAGE CONTENT -->
    <x-layout.content>
        <!-- Menu create -->

        <x-item.button wire:click.prevent="createMenu" size="small"
                       class="!block w-auto dark:bg-green-700 dark:hover:bg-green-800 ">
            <x-svg.add class="flex w-4 h-4 dark:text-green-200 dark:hover:text-white"></x-svg.add>
            <span class="flex ml-1 dark:text-green-200 dark:hover:text-white">{{__('Create')}}</span>
        </x-item.button>

        <x-item.modal size="small" type="{{$formType}}" modalHeader="{{$modalHeader}}">
            <x-item.form method="POST">
                @if($formType === 'create' || $formType === 'update')
                    <div class="grid grid-cols-1 gap-4">
                        <x-item.elements.input wireName="menu.name" updating="defer" name="menu-name" label="Name"
                                               placeholder="Enter a name for menu "></x-item.elements.input>



                        <x-item.elements.select wireName="menu.guard" name="menu-guard" label="Guard" :data=$guards
                                                placeholder=""></x-item.elements.select>

                        <x-item.elements.select wireName="menu.route" name="menu-route" label="Route" :data=$routes
                                                placeholder="Choose a route"></x-item.elements.select>

                        <x-item.elements.input wireName="menu.sort" updating="defer" name="menu-sort" label="Sort"
                                               placeholder="Order of this menu"></x-item.elements.input>
                        {{--                        <x-item.elements.select wireName="menu.menuID" name="menu-menuID" label="Belongs to"--}}
                        {{--                                                :data=$parentData--}}
                        {{--                                                placeholder=""></x-item.elements.select>--}}
                    </div>
                @endif

                @if($formType === 'delete' )
                    <div class="grid grid-cols-1 gap-4">
                        <p class="text-gray-900 dark:text-white text-center"><span class="font-bold mb-2 text-red-600">WARNING!</span>
                            <br> Are you sure you want to delete? All the child menu will be deleted as well.</p>
                    </div>
                @endif
                <x-item.form-submit formType="{{$formType}}" type="submit" name="{{$submitName}}"></x-item.form-submit>
            </x-item.form>
        </x-item.modal>

        <!-- Menu datatable -->
        <div class="flex  justify-center items-center w-full mt-3">
            <div class="flex flex-row flex-wrap w-full  justify-center">
                @foreach($menus as $menu)
                    <div
                        class="flex flex-col w-72 mx-[10px] my-[10px] shadow-lg bg-white border shadow-sm rounded-xl dark:bg-oblue-300  dark:border-oblue-100">
                        <div
                            class="class=flex flex-col bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-3 dark:bg-oblue-100 dark:border-olblue-800/[0.5]">
                            <div class="flex items-center">
                                <div wire:click.prevent="createMenu({{$menu->id}})"
                                     class="flex transition-all duration-300 cursor-pointer  group hover:bg-green-600 hover:text-white hover:border-green-500 dark:hover:border-green-700 dark:hover:bg-green-700 flex w-8 h-8 border rounded-md border-gray-200 dark:border-olblue-800/[0.5] justify-center items-center">
                                    <x-svg.add
                                        class=" !w-4 !h-4 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.add>
                                </div>
                                <p wire:click="editMenu({{$menu}})"
                                   class="transition-all duration-300 cursor-pointer flex mx-2 px-2 py-1 justify-center items-center  w-8 h-8 border rounded-md dark:border-olblue-800/[0.5] dark:hover:text-white dark:hover:bg-blue-700 flex-grow text-sm text-gray-900 dark:text-olblue-300 font-bold capitalize">
                                    <span class="flex uppercase ">{{$menu->name}}</span>
                                </p>
                                <div wire:click="deleteMenu({{$menu}})"
                                     class="flex transition-all duration-300 cursor-pointer  group hover:bg-red-600 hover:text-white hover:border-red-400 dark:hover:border-red-700  dark:hover:bg-red-700 flex w-8 h-8 border rounded-md border-gray-200 dark:border-olblue-800/[0.5] justify-center items-center">
                                    <x-svg.close class=" !w-3 !h-3 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.close>
                                </div>

                            </div>
                        </div>
                        <div class="py-3 px-4 md:py-4 md:px-4">

                            <ul>
                                @foreach($menu->childMenus as $childMenu1)
                                    <li class="dark:text-gray-300 my-2">
                                        <div class="inline-flex flex-row bg-gray-100 dark:bg-blue-900 px-2 py-1 rounded-md capitalize font-bold text-sm items-center items-center">
                                            <div wire:click.prevent="createMenu({{$childMenu1->id}})"
                                                 class="flex  transition-all duration-300 cursor-pointer  border-gray-200  group hover:bg-green-600 hover:text-white hover:border-green-500 dark:border-gray-100/[0.2] dark:hover:border-green-700  dark:hover:bg-green-700 flex w-6 h-6 border rounded-md   justify-center items-center">
                                                <x-svg.add class=" flex !w-3 !h-3 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.add>
                                            </div>
                                            <span  wire:click.prevent="editMenu({{$childMenu1}},'l1')" class="transition-all duration-300 cursor-pointer mx-2 dark:hover:text-white dark:text-blue-100 text-gray-700  hover:text-gray-900 flex h-6 justify-center items-center"> {{$childMenu1->name}} </span>
                                            <div wire:click="deleteMenu({{$childMenu1}})"
                                                 class="flex transition-all duration-300 cursor-pointer  group hover:bg-red-600 hover:text-white dark:border-gray-100/[0.2] hover:border-red-400 dark:hover:border-red-700  dark:hover:bg-red-700 flex w-6 h-6 border rounded-md border-gray-200 dark:border-gray-100/[0.2] justify-center items-center">
                                                <x-svg.close class=" !w-2 !h-2 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.close>
                                            </div>
                                        </div>
                                    </li>



                                    <ul class="ml-5">
                                        @foreach($childMenu1->childMenus as $childMenu2)
                                            <li class="dark:text-gray-300 my-2">
                                                <div class="inline-flex flex-row capitalize text-sm items-center px-2 py-1 rounded-md border dark:border-olblue-800/[0.5]">
                                                    <div wire:click.prevent="createMenu({{$childMenu2->id}})"
                                                         class="flex  transition-all duration-300 cursor-pointer  group hover:bg-green-600 hover:text-white hover:border-green-500 dark:hover:border-green-700  dark:hover:bg-green-700 flex w-6 h-6 border rounded-md border-gray-200 dark:border-olblue-800/[0.5] justify-center items-center">
                                                        <x-svg.add class=" flex !w-3 !h-3 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.add>
                                                    </div>
                                                    <span  wire:click.prevent="editMenu({{$childMenu2}},'l2')" class="transition-all duration-300 cursor-pointer dark:hover:text-blue-500 mx-2 flex h-6 justify-center items-center"> {{$childMenu2->name}} </span>
                                                    <div wire:click="deleteMenu({{$childMenu2}})"
                                                         class="flex transition-all duration-300 cursor-pointer  group hover:bg-red-600 hover:text-white hover:border-red-400 dark:hover:border-red-700  dark:hover:bg-red-700 flex w-6 h-6 border rounded-md border-gray-200 dark:border-olblue-800/[0.5] justify-center items-center">
                                                        <x-svg.close class=" !w-2 !h-2 dark:text-olblue-300 dark:group-hover:text-white "></x-svg.close>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>



                                @endforeach

                            </ul>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-layout.content>
</x-layout.main>
