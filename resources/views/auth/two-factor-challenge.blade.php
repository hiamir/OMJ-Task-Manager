<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="flex items-end justify-end items-center">
                <span class="flex bg-red-700 px-2 py-1.5 rounded-md">
                     <form action="{{ route('admin.twoFactorLogout') }}" method="post">
                @csrf
                <button type="submit" class="flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer text-gray-200 hover:text-white w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
</svg>


                </button>
            </form>

                </span>


            </div>
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-jet-validation-errors class="mb-4"/>

            <form method="POST"
                  action="{{ (Session::get('table') ==='admins') ? route('admin.two-factor.login') : route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-label for="code" value="{{ __('Code') }}"/>
                    <x-jet-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code"
                                 autofocus x-ref="code" autocomplete="one-time-code"/>
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label for="recovery_code" value="{{ __('Recovery Code') }}"/>
                    <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code"
                                 x-ref="recovery_code" autocomplete="one-time-code"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                            x-show="! recovery"
                            x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                            x-show="recovery"
                            x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </button>

                    <x-jet-button class="ml-4">
                        {{ __('Log in') }}
                    </x-jet-button>




                </div>
            </form>

        </div>
    </x-jet-authentication-card>
</x-guest-layout>
