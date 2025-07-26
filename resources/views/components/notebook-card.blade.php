@props([
    'chainDots' => 10,
    'chainSpacing' => 'md:space-y-8',
    'extraClasses' => '', // will allow the passing of extra classes, just in case
])

<div class="bg-gray-50 rounded-3xl relative overflow-visible shadow-xl z-10 {{ $extraClasses }}">
    <!-- Decorative chain in the middle -->
    <div class="absolute left-1/2 top-0 bottom-0 w-8 transform -translate-x-1/2 flex flex-col items-center justify-center {{ $chainSpacing }} z-20">
        @for($i = 0; $i < $chainDots; $i++)
            <div class="hidden md:block w-8 h-8 bg-hw-dark rounded-full"></div>
        @endfor
        <div class="hidden md:block absolute bg-hw-dark h-full w-2"></div>
    </div>

    <!-- Slot for inner content -->
    <div class="relative w-full h-full">
        {{ $slot }}
    </div>
</div>
