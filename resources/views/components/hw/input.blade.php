@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full py-2 px-3 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs']) !!}>
