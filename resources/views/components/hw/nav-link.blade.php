@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-6 py-0.5 uppercase text-gray-950 ease-in-out bg-hw-blue-400 rounded-4xl font-bayon'
                : 'inline-flex items-center px-1 py-0.5 uppercase text-gray-100 ease-in-out font-bayon border-b border-transparent hover:border-hw-blue transition-all';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
