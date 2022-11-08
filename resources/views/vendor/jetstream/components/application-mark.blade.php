<a class="flex xs: !min-w-[2.5rem] sm:!min-w-[3.0rem] justify-center items-start" href="{{ (Auth::guard('admin')->check()) ? route('admin.dashboard') : route('dashboard') }}">
    <img class="flex lg:w-16 h-16  hidden"
         :class="{ '!flex': darkMode===true }"
         src="{{ asset('storage/logo-dark.svg') }}" alt="">
    <img class="flex w-16 h-16 hidden"
         :class="{ '!flex': darkMode===false}"
         src="{{ asset('storage/logo-light.svg') }}" alt="">
</a>
