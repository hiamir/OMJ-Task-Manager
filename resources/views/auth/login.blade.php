<x-guest-layout>
    <x-jet-authentication-card guard="{{isset($guard) ? $guard : 'web'}}" >
        <x-slot name="logo" class="">
            <div class="flex flex-col justify-center items-center">
                <x-jet-authentication-card-logo/>

            </div>
        </x-slot>
        <div class="flex flex-col items-center justify-center  ">
            <p >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="flex self-center dark:text-olblue-600 w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
            </svg>
            </p>
            <button x-show="guard==='admin'" type="button"
                    class="hidden py-1 px-3 mt-3 mb-2 text-xs font-medium text-center text-white dark:text-red-100
                    bg-red-700 rounded-2xl  dark:hover:bg-red-900 "
                    :class="{ 'flex' : guard==='admin', 'hidden' : guard!=='admin' }"
            >
                Administrator Area
            </button>
        </div>
        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ (isset($guard) && $guard==='admin') ? route('admin.login') : route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required autofocus/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="current-password"/>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember"/>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-olblue-600 dark:hover:text-olblue-500"
                       href="{{ (isset($guard) && $guard==='admin') ?   route('admin.password.request') :  route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
