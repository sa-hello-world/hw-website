<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-block rounded-xl border-hw-blue border-2 px-4 py-2 text-hw-blue hover:bg-gray-700 transition']) }}>
    {{ $slot->isEmpty() ? ($text ?? 'Button') : $slot }}
</a>
