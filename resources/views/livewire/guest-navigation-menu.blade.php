<nav x-data="{ open: false }"
     class="relative z-40 bg-hw-dark">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap items-center justify-between h-16">
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
                    <x-hw.nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                                      wire:navigate.hover>
                        {{ __('Login') }}
                    </x-hw.nav-link>
                    <x-hw.nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                                   wire:navigate.hover>
                        {{ __('Register') }}
                    </x-hw.nav-link>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="mr-0 flex items-center md:hidden">
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
    <div :class="{'block': open, 'hidden': ! open}" class="bg-waitt-dark hidden md:hidden">
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
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('login') }}"
                                         :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-hw.responsive-nav-link>
            <x-hw.responsive-nav-link wire:navigate.hover href="{{ route('register') }}"
                                         :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-hw.responsive-nav-link>
        </div>
    </div>
</nav>
