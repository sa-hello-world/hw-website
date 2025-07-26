@props(['value'])

@php
    $isRequired = $attributes->has('required');
@endphp

<label {{ $attributes->merge([
    'class' => 'block text-sm font-medium text-white mb-1' .
        ($isRequired ? " after:content-['*'] after:ml-1 after:text-red-500" : '')
]) }}>
    {{ $value ?? $slot }}
</label>
