@php use Illuminate\Support\Facades\Route; @endphp
<div class="w-full">
    <ul class="flex border-b border-gray-500 mb-6">
        <x-hw.nav-link
            :href="route('settings.profile')"
            wire:navigate
            class="px-4 py-2 -mb-px border-b-2 transition {{Route::is('settings.profile') ? 'underline text-hw-blue' : ''}}"
        >
            {{ __('Profile') }}
        </x-hw.nav-link>

        <x-hw.nav-link
            :href="route('settings.password')"
            wire:navigate
            class="px-4 py-2 -mb-px border-b-2 transition {{Route::is('settings.password') ? 'underline text-hw-blue' : ''}}"
        >
            {{ __('Password') }}
        </x-hw.nav-link>
    </ul>

    <div class="max-w-lg">
        <h1 class="text-xl font-bayon text-white">{{ $heading ?? '' }}</h1>
        <p class="text-gray-400">{{ $subheading ?? '' }}</p>
        <div class="mt-5">
            {{ $slot }}
        </div>
    </div>
</div>
