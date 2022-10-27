<a href="{{ (Auth::guard('admin')->check()) ? route('admin.dashboard') : route('dashboard') }}">
    <img class="w-16 h-16 hidden"
         :class="{ '!block': darkMode===true }"
         src="{{ asset('storage/logo-dark.svg') }}" alt="">
    <img class="w-16 h-16 hidden"
         :class="{ '!block': darkMode===false}"
         src="{{ asset('storage/logo-light.svg') }}" alt="">
</a>
