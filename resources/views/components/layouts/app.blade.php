<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&ital@0;1&display=swap"
        rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-waitt-dark">

<div>
    <div class="text-black dark:text-white">
        @if (!Str::contains(Request::url(), ['errors']))
            @guest()
                @livewire('guest-navigation-menu')
            @endguest
            @auth()
                @livewire('auth-navigation-menu')
            @endauth
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</div>

<x-hw.footer/>

@stack('modals')
@stack('scripts')
@livewireScripts
</body>
</html>
