<div>
    <!-- Sidebar -->
    <div id="docs-sidebar"
         class=
         "hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-white border-r border-slate-200 pb-10 overflow-y-auto scrollbar-y lg:block lg:translate-x-0 lg:right-auto lg:bottom-0 dark:scrollbar-y dark:bg-oblue-600 dark:border-oblue-100 "
    >

        {{--        <button type="button" class="w-8 h-8 inline-flex justify-center items-center gap-2 rounded-md border border-gray-200 text-gray-600 hover:text-gray-400 transition dark:border-gray-700" data-hs-overlay="#docs-sidebar" aria-controls="docs-sidebar" aria-label="Toggle navigation">--}}
        {{--            <span class="sr-only">Close Sidebar</span>--}}
        {{--            <svg class="w-3 h-3" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">--}}
        {{--                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>--}}
        {{--            </svg>--}}
        {{--        </button>--}}
        <div
            class="flex flex-col justify-center items-center px-6 xs:!h-[128px] lg:!h-[146px] border-b dark:border-oblue-100">
            <x-jet-application-mark class="flex h-9 w-auto"/>
            <x-jet-nav-link class="flex"
                            href="{{ (Auth::guard('admin')->check() && explode('.',Route::currentRouteName())[0] ==='admin') ? route('admin.dashboard') : route('dashboard') }}"
                            :active="request()->routeIs('dashboard')">
                {{ __('Task Manager') }}
            </x-jet-nav-link>
        </div>

        <x-layout.sidebar.parent>

            <x-layout.sidebar.child-one :name="'Dashboard'"  href="{{ (Auth::guard('admin')->check() && explode('.',Route::currentRouteName())[0] ==='admin') ? route('admin.dashboard') : route('dashboard') }}"></x-layout.sidebar.child-one>
            <x-layout.sidebar.child-one :name="'Menu'"  href="{{route('admin.menu')}}"></x-layout.sidebar.child-one>
            <x-layout.sidebar.child-one :name="'Menu Level'"  href="{{route('admin.menu-level')}}"></x-layout.sidebar.child-one>



            @foreach($sideBar as $parent)
                @if(array_key_exists(lcfirst($parent['name']), $sideBarChildOne))
                    <x-layout.sidebar.child-one :id="$parent['name'].'-accordion'" :childCount="count($sideBarChildOne[lcfirst($parent['name'])])" :name="ucfirst($parent['name'])">
                        @if(count($sideBarChildOne[lcfirst($parent['name'])]) > 0)
                            @foreach($sideBarChildOne[lcfirst($parent['name'])] as $childOneData)
{{--                            <ul class="hs-accordion-group pl-3 pt-2" data-hs-accordion-always-open>--}}
{{--                                <x-layout.sidebar.child-one :id="$parent['name'].'-accordion-sub-1'" :childCount="count($sideBarChildOne[lcfirst($parent['name'])])" :name="ucfirst($childOneData[$parent['name']]['name'])">--}}

{{--                                </x-layout.sidebar.child-one>--}}
{{--                            </ul>--}}
                            @endforeach
                            @endif
                    </x-layout.sidebar.child-one>
                    @endif
{{--                {{   dd(array_key_exists(lcfirst($parent['name']), $sideBarChildOne)) }}--}}
{{--                {{   dd(array_key_exists('parent', $sideBarChildOne[lcfirst($parent['name'])])) }}--}}

{{--                <x-layout.sidebar.child-one :id="$parent.'-accordion'" :childCount="count($parentData)" :name="'Users'">--}}
{{--                    @if(count($childOneData) > 0)--}}
{{--                        @foreach($parentData as $childOne=>$childOneData)--}}
{{--                            <ul class="hs-accordion-group pl-3 pt-2" data-hs-accordion-always-open>--}}
{{--                                <x-layout.sidebar.child-one :id="$parent.'-accordion-sub-1'"--}}
{{--                                                            :childCount="count($childOneData)" :name="$childOne">--}}
{{--                                    <x-layout.sidebar.child-two :links="$childOneData"></x-layout.sidebar.child-two>--}}
{{--                                </x-layout.sidebar.child-one>--}}
{{--                            </ul>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </x-layout.sidebar.child-one>--}}

            @endforeach
{{--            <x-layout.sidebar.child-one :id="'users-accordion'" :name="'Users'">--}}
{{--                <ul class="hs-accordion-group pl-3 pt-2" data-hs-accordion-always-open>--}}
{{--                    <x-layout.sidebar.child-one :id="'users-accordion-sub-1'" :name="'Data'">--}}
{{--                        <x-layout.sidebar.child-two :links="['data1', 'data2']"></x-layout.sidebar.child-two>--}}
{{--                    </x-layout.sidebar.child-one>--}}
{{--                </ul>--}}
{{--            </x-layout.sidebar.child-one>--}}


            <li class="hs-accordion" id="users-accordion">
                <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-slate-100  dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white"
                   href="javascript:;">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path>
                    </svg>
                    Users

                    <x-layout.sidebar.arrow-direction></x-layout.sidebar.arrow-direction>
                </a>

                <div id="users-accordion"
                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                    <ul class="hs-accordion-group pl-3 pt-2" data-hs-accordion-always-open>
                        <li class="hs-accordion" id="users-accordion-sub-1">
                            <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-slate-100  dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white"
                               href="javascript:;">
                                Sub Menu 1

                                <x-layout.sidebar.arrow-direction></x-layout.sidebar.arrow-direction>
                            </a>

                            <div id="users-accordion-sub-1"
                                 class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                                <ul class="pt-2 pl-2">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                           href="javascript:;">
                                            Link 1
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                           href="javascript:;">
                                            Link 2
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                           href="javascript:;">
                                            Link 3
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="hs-accordion" id="users-accordion-sub-2">
                            <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white"
                               href="javascript:;">
                                Sub Menu 2

                                <x-layout.sidebar.arrow-direction></x-layout.sidebar.arrow-direction>
                            </a>

                            <div id="users-accordion-sub-2"
                                 class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden pl-2">
                                <ul class="pt-2 pl-2">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                           href="javascript:;">
                                            Link 1
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                           href="javascript:;">
                                            Link 2
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                           href="javascript:;">
                                            Link 3
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="hs-accordion" id="account-accordion">
                <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white"
                   href="javascript:;">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd"
                              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    Account

                    <x-layout.sidebar.arrow-direction></x-layout.sidebar.arrow-direction>
                </a>

                <div id="account-accordion"
                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                    <ul class="pt-2 pl-2">
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                               href="javascript:;">
                                Link 1
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                               href="javascript:;">
                                Link 2
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                               href="javascript:;">
                                Link 3
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="hs-accordion" id="projects-accordion">
                <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white"
                   href="javascript:;">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z"></path>
                        <path
                            d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z"></path>
                    </svg>
                    Projects

                    <x-layout.sidebar.arrow-direction></x-layout.sidebar.arrow-direction>
                </a>

                <div id="projects-accordion"
                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                    <ul class="pt-2 pl-2">
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                               href="javascript:;">
                                Link 1
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                               href="javascript:;">
                                Link 2
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                               href="javascript:;">
                                Link 3
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500"
                   href="javascript:;">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg>
                    Calendar
                </a></li>
            <li>
                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500"
                   href="javascript:;">
                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                    Documentation
                </a></li>
        </x-layout.sidebar.parent>
    </div>
    <!-- End Sidebar -->


</div>
