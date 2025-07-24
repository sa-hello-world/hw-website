@php
    $colors = [
        'gold' => 'border-yellow-500 text-yellow-500',
        'silver' => 'border-zinc-500 text-zinc-500',
        'bronze' => 'border-amber-800 text-amber-800',
        'success' => 'text-green-600',
        'danger'  => 'text-red-600',
        'warning' => 'text-yellow-600',
        'neutral' => 'text-neutral-900',
    ];

    $theme = $colors[$color ?? 'neutral'];
@endphp

<div class="rounded-xl bg-hw-dark border border-2 p-4 shadow-sm transition hover:shadow-md {{ $theme }}">
    <div class="text-sm font-medium text-neutral-400">
        {{ $label ?? 'Stat' }}
    </div>
    <div class="mt-1 text-2xl font-semibold">
        {{ $value ?? '-' }}
    </div>
</div>
