<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <x-hw.label for="name" value="Name"/>
            <x-hw.input
                type="text"
                wire:model="name"
                required
            />
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror

            <div>
                <x-hw.label for="email" value="Email"/>
                <x-hw.input
                    type="email"
                    wire:model="email"
                    required autocomplete="email"
                />
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <x-hw.button variant="save" type="submit" class="w-full">{{ __('Save') }}</x-hw.button>
                </div>

                <x-action-message class="me-3 text-white" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
