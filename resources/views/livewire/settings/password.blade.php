<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <div>
                <x-hw.label for="current_password" value="Current password"/>
                <x-hw.input
                    wire:model="current_password"
                    type="password"
                    required
                    autocomplete="current-password"
                />
                @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <x-hw.label for="password" value="New Password"/>
                <x-hw.input
                    wire:model="password"
                    type="password"
                    required
                    autocomplete="new-password"
                />
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <x-hw.label for="password_confirmation" value="Confirm Password"/>
                <x-hw.input
                    wire:model="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                />
                @error('password_confirmation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <x-hw.button variant="save" type="submit" class="w-full">Save</x-hw.button>
                </div>

                <x-action-message class="me-3 text-white" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
