@php
    $colors = [
        'gold'    => 'border-yellow-500 text-yellow-500 bg-yellow-900',
        'silver'  => 'border-zinc-400 text-zinc-400 bg-zinc-900',
        'bronze'  => 'border-amber-600 text-amber-600 bg-amber-900',
        'success' => 'border-green-600 text-green-600 bg-green-900',
        'upcoming' => 'border-green-600 text-green-600 bg-green-900',
        'danger'  => 'border-red-600 text-red-600 bg-red-900',
        'warning' => 'border-yellow-600 text-yellow-600 bg-yellow-900',
        'current' => 'border-yellow-600 text-yellow-600 bg-yellow-900',
        'neutral' => 'border-neutral-900 text-neutral-900 bg-neutral-800',
        'past' => 'border-zinc-400 text-zinc-400 bg-zinc-900',
    ];

    $theme = $colors[$color ?? 'neutral'];
@endphp

<span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $theme }}">
    {{ $label ?? 'Badge' }}
</span>
