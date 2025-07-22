@props(['href' => '#', 'label'])

<a href="{{ $href }}"
   class="inline-block px-6 py-3 rounded-full font-bold text-white bg-hw-blue hover:bg-blue-400 transition">
    {{ $label }}
</a>
