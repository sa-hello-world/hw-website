@props([
    'type' => 'submit',
    'variant' => 'default',
])

@php
    $variantClasses = match($variant) {
        'save' => 'border-hw-blue text-hw-blue',
        'danger' => 'border-red-600 text-red-600',
        'default' => 'border-gray-600 text-gray-400 ',
    };
@endphp

<button {{ $attributes->merge([
    'type' => $type,
    'class' => "inline-flex items-center px-5 py-2 border 0 rounded-md font-medium text-xs hover:bg-gray-700 uppercase tracking-widest hover:cursor-pointer active:bg-gray-900 transition ease-in-out duration-150 $variantClasses"
]) }}>
    {{ $slot }}
</button>
