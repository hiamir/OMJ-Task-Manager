@props(['guard'=>explode('/',$request->getRequestUri())[1]])
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST"
              action="{{  ($guard === 'admin') ? route('admin.password.update') : route('password.update')  }}">
            @csrf

            <input type="hidden" name="token" value="{{  $request->route('token') }}">
            <div class="flex justify-center">


                <p class="flex flex-row justify-center items-center text-gray-900 text-xs uppercase dark:text-olblue-300 px-3 py-3 border border-gray-300 dark:border-olblue-800 rounded-xl font-semibold">
                    <span class="flex mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class=" w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>
                    </svg>
                        </span>
                    <span class="flex" x-text="'Reset you Password'"></span>
                </p>
            </div>

                        <div class="block">
{{--                            <x-jet-label for="email" value="{{ __('Email') }}" />--}}
                            <x-jet-input id="email" class="block mt-1 w-full" type="hidden" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
