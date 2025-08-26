@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'font-bayon block w-full pl-3 pr-4 py-2 border-l-4 border-waitt-pink text-left text-base font-medium text-hw-blue bg-waitt-yellow focus:outline-hidden transition duration-150 ease-in-out'
                : 'font-bayon block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-200 hover:text-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
