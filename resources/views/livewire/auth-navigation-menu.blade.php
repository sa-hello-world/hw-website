<!-- TODO: Fix the links of the dropdown -->
<nav x-data="{ open: false }"
     class="relative z-40 bg-hw-dark">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <a href="{{route('welcome')}}" class="mb-2 mx-6 md:mx-0">
                    <img src="{{ asset('/img/main_logo_inline_white.png') }}" alt="HW Logo" class="h-9 w-auto max-w-full"/>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-hw.nav-link href="{{ route('welcome') }}" :active="request()->routeIs('dashboard')"
                                   wire:navigate.hover>
                        {{ __('Home') }}
                    </x-hw.nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-hw.nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')"
                                   wire:navigate.hover>
                        {{ __('About Us') }}
                    </x-hw.nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-hw.nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')"
                                   wire:navigate.hover>
                        {{ __('Shenanigans') }}
                    </x-hw.nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-hw.nav-link href="{{ route('partners') }}" :active="request()->routeIs('partners')"
                                   wire:navigate.hover>
                        {{ __('Partners') }}
                    </x-hw.nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-hw.nav-link href="{{ route('events') }}" :active="request()->routeIs('events')"
                                   wire:navigate.hover>
                        {{ __('Events') }}
                    </x-hw.nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-hw.nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')"
                                   wire:navigate.hover>
                        {{ __('Say Hello!') }}
                    </x-hw.nav-link>
                </div>
            </div>

            <div class="grow flex justify-end">
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 md:flex">
                    <x-hw.dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span
                                class="bg-waitt-dark hover:cursor-pointer inline-flex py-1 pr-2 rounded-md text-gray-200 hover:text-gray-400 focus:outline-hidden transition ease-in-out duration-150"
                            >
                                <div :class="open ? 'text-waitt-yellow' : 'text-gray-200'"
                                     class="inline-flex items-center px-3 border border-transparent leading-4 font-medium rounded-md"
                                >
                                    {{ Auth::user()->name }}
                                </div>
                                <svg
                                    class="w-4 h-4 transform transition-transform duration-300"
                                    :class="open ? 'rotate-180 text-waitt-yellow' : 'rotate-0 text-gray-200'"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <x-hw.dropdown-link href="{{ route('dashboard') }}" wire:navigate.hover>
                                {{ __('My hub') }}
                            </x-hw.dropdown-link>
                            <x-hw.dropdown-link href="{{ route('settings.profile') }}" wire:navigate.hover>
                                {{ __('Profile') }}
                            </x-hw.dropdown-link>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-hw.dropdown-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-hw.dropdown-link>
                            </form>
                        </x-slot>
                    </x-hw.dropdown>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="mr-0 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 focus:outline-hidden transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="bg-waitt-dark hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('welcome') }}"
                                      :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-hw.responsive-nav-link>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('aboutus') }}"
                                      :active="request()->routeIs('aboutus')">
                {{ __('About us') }}
            </x-hw.responsive-nav-link>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('welcome') }}"
                                      :active="request()->routeIs('welcome')">
                {{ __('Shenanigans') }}
            </x-hw.responsive-nav-link>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('partners') }}"
                                      :active="request()->routeIs('partners')">
                {{ __('Partners') }}
            </x-hw.responsive-nav-link>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('events') }}"
                                      :active="request()->routeIs('events')">
                {{ __('Events') }}
            </x-hw.responsive-nav-link>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('events') }}"
                                      :active="request()->routeIs('events')">
                {{ __('Say hello!') }}
            </x-hw.responsive-nav-link>
            <div class="border-t border-gray-200 dark:border-gray-600"></div>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('dashboard') }}"
                                      :active="request()->routeIs('dashboard')">
                {{ __(Auth::user()->name) }}
            </x-hw.responsive-nav-link>
            <div class="border-t border-gray-200 dark:border-gray-600"></div>
        </div>
    </div>
</nav>
