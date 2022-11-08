<div class="whitespace-nowrap mr-5 lg:mr-0 lg:hidden">
    <div class="hidden space-x-8 sm:-my-px sm:ml-0 xs:flex justify-start items-center">
        <x-jet-application-mark class="flex h-9 w-auto"/>
        <x-jet-nav-link class="flex sm:!ml-3" href="{{ (Auth::guard('admin')->check() && explode('.',Route::currentRouteName())[0] ==='admin') ? route('admin.dashboard') : route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Task Manager') }}
        </x-jet-nav-link>
    </div>
</div>
