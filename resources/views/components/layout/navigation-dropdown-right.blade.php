<div class="hs-dropdown relative inline-flex" data-hs-dropdown-placement="bottom-right">
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <button id="hs-dropdown-with-header" type="button"
                class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-white text-slate-700 align-middle hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-oblue-600 dark:hover:bg-slate-800 dark:text-slate-400 dark:hover:text-white dark:focus:ring-slate-700 dark:focus:ring-offset-slate-800">
            <img
                class="h-8 w-8 rounded-full object-cover h-[2.375rem] w-[2.375rem] rounded-full ring-2 ring-white dark:ring-slate-800"
                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
        </button>
    @else
        <span class="inline-flex rounded-md">
                                                            <button type="button"
                                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-100/[0.2] focus:outline-none transition">
                                                                {{ Auth::user()->name }}

                                                                <svg class="ml-2 -mr-0.5 h-4 w-4"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                          clip-rule="evenodd"/>
                                                                </svg>
                                                            </button>
                                                        </span>
    @endif

    <div
        class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white border-slate-200 shadow-md dark:shadow-oblue-900/[.5] rounded-lg p-2 dark:bg-oblue-600 border dark:border-oblue-100 divide-y divide-gray-200  dark:border dark:border-oblue-100 dark:divide-oblue-100"
        aria-labelledby="hs-dropdown-with-header">
        <div
            class="py-3 px-5 -m-2 bg-white border-slate-200 rounded-t-lg dark:bg-oblue-600 border-b dark:border-oblue-100">
            <p class="text-sm text-slate-500 dark:text-slate-400">Signed in as</p>
            <p class="text-sm font-medium text-slate-800 dark:text-slate-300"> {{ Auth::user()->email }}</p>
        </div>
        <div class="mt-2 py-2 first:pt-0 last:pb-0 !border-[0px]">
            <x-layout.dropdown-icon-link
                href="{{ ((Auth::guard('admin')->check() && explode('.',Route::currentRouteName())[0] ==='admin')) ? route('admin.profile.show') : route('profile.show') }}">
                <x-svg.profile width="16" height="16"></x-svg.profile>
                {{ __('Profile') }}
            </x-layout.dropdown-icon-link>
        </div>
        <div class="py-2 first:pt-0 last:pb-0">
            <x-layout.dropdown-icon-link>
                <x-svg.gear width="16" height="16"></x-svg.gear> {{ __('Account Settings') }}
            </x-layout.dropdown-icon-link>

            {{--     ------- Logout  --------        --}}
            <form method="POST"
                  action="{{ ((Auth::guard('admin')->check() && explode('.',Route::currentRouteName())[0] ==='admin')) ? route('admin.logout') : route('logout') }}"
                  x-data>
                @csrf

                <x-layout.dropdown-icon-link
                    href="{{ (auth()->guard('admin')->check()) ? route('admin.logout') : route('logout') }}"
                    @click.prevent="$root.submit();"
                >
                    <x-svg.signout width="16" height="16"></x-svg.signout> {{ __('Sign out') }}
                </x-layout.dropdown-icon-link>

            </form>
        </div>
    </div>
</div>
