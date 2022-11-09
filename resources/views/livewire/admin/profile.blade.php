<div>
    @livewire('layout.navigation')
    @livewire('layout.toggle')
    @livewire('layout.sidebar')
    @livewire('layout.header',['header'=>$pageHeader])

    <!-- Page Content -->
    <x-layout.content>


        <div>
            <div class="max-w-7xl mx-auto py-0 sm:px-6 lg:px-0">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @if(Auth::guard('admin')->check())
                        @livewire('admin-update-profile-information-form')
                    @else
                        @livewire('profile.update-profile-information-form')
                    @endif
                    <x-jet-section-border/>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>

                    <x-jet-section-border />
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-10 sm:mt-0">

                        @if(Auth::guard('admin')->check())
                            @livewire('admin-two-factor-authentication-form')
                        @else
                            @livewire('profile.two-factor-authentication-form')
                        @endif

                    </div>

                    <x-jet-section-border />
                @endif

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <x-jet-section-border />

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>




    </x-layout.content>

</div>
