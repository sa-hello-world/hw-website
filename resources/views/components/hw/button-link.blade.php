<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-block rounded-xl bg-hw-blue-500 px-4 py-2 text-white hover:bg-hw-blue-700 transition']) }}>
    {{ $slot->isEmpty() ? ($text ?? 'Button') : $slot }}
</a>
