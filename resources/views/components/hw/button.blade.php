@props(['href' => '#', 'label'])

<a href="{{ $href }}"
   class="inline-block px-8 py-2 rounded-2xl font-bayon text-2xl tracking-wider uppercase text-white bg-hw-blue hover:bg-hw-blue-600 transition">
    {{ $label }}
</a>
