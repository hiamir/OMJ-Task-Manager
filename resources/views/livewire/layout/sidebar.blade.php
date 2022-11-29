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
                            href="{{ (Auth::guard('admin')->check())  ? route('admin.dashboard') : route('dashboard') }}"
                            :active="request()->routeIs('dashboard')">
                {{ __('Task Manager') }}
            </x-jet-nav-link>
        </div>

        <x-layout.sidebar.parent>
                @foreach($sideBar as $menu)
                        <li class="hs-accordion @if(($menu->route !== null)){{ (strpos(Route::currentRouteName(), route($menu->route)) == 0) ? 'active' : '' }} @endif" id="{{$menu->id}}-accordion">
                            <a class="hs-accordion-toggle flex items-center gap-x-2.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm font-semibold text-slate-700 rounded-md hover:bg-slate-100  dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white dark:hs-accordion-active:bg-oblue-100"
                               href=@if(count($menu->childMenus) > 0) "javascript:;" @else @if($menu->route !== null)"{{route($menu->route)}}" @else "javascript:;" @endif  @endif>
                            <x-svg.select :type="$menu->svg" class="h-5 w-5"></x-svg.select>{{$menu->name}}
                              @if(count($menu->childMenus) > 0)  <x-layout.sidebar.arrow-direction/> @endif
                            </a>

                            <div id="{{$menu->id}}-accordion"
                                 class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                                <ul class="hs-accordion-group pt-2" data-hs-accordion-always-open>

                                    @foreach($menu->childMenus as $childMenu1)
                                    <li class="hs-accordion" id="{{$menu->id}}-accordion-sub-1">
                                        <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 pl-9 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-slate-100  dark:hover:bg-oblue-500 dark:text-slate-400 dark:hover:bg-oblue-500 dark:hs-accordion-active:text-white"
                                           href=@if(count($childMenu1->childMenus) > 0 ) "javascript:;" @else  @if($childMenu1->route !== null)"{{ route($childMenu1->route) }}" @else "javascript:;" @endif   @endif">
                                            {{$childMenu1->name}}
                                            @if(count($childMenu1->childMenus) > 0)  <x-layout.sidebar.arrow-direction/> @endif
                                        </a>
                                        <div id="{{$menu->id}}-accordion-sub-1"
                                             class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                                            <ul class="pl-0">

                                                @foreach($childMenu1->childMenus as $childMenu2)
                                                <li>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 pl-10 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
                                                       href="{{ route($childMenu2->route) }}">
                                                        {{$childMenu2->name}}
                                                    </a>
                                                </li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>
                        </li>
                @endforeach
        </x-layout.sidebar.parent>
    </div>
    <!-- End Sidebar -->


</div>
