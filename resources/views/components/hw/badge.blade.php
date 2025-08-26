@php
    use App\Enums\EventStatus;
    use App\Enums\EventType;use App\Enums\PaymentStatus;
    use App\Enums\SponsorshipTier;

    $colors = [
        SponsorshipTier::GOLD->value => 'border-yellow-500 text-yellow-500 bg-yellow-900',
        SponsorshipTier::SILVER->value  => 'border-zinc-400 text-zinc-400 bg-zinc-900',
        SponsorshipTier::BRONZE->value  => 'border-amber-600 text-amber-600 bg-amber-900',
        'success' => 'border-green-600 text-green-600 bg-green-900',
        EventStatus::UPCOMING->value => 'border-green-600 text-green-600 bg-green-900',
        EventStatus::PAST->value => 'border-zinc-400 text-zinc-400 bg-zinc-900',
        EventStatus::CURRENT->value => 'border-yellow-600 text-yellow-600 bg-yellow-900',
        'danger'  => 'border-red-600 text-red-600 bg-red-900',
        'warning' => 'border-yellow-600 text-yellow-600 bg-yellow-900',
        'neutral' => 'border-neutral-900 text-neutral-900 bg-neutral-800',
        'membership' => 'border-blue-400 text-blue-400 bg-blue-900',
        'event' => 'border-indigo-400 text-indigo-400 bg-indigo-900',
        PaymentStatus::PENDING->value => 'border-yellow-500 text-yellow-500 bg-yellow-900',
        PaymentStatus::PAID->value => 'border-green-600 text-green-600 bg-green-900',
        EventType::COMPANY_VISIT->value => 'border-blue-400 text-blue-400 bg-blue-900',
        EventType::WORKSHOP->value      => 'border-purple-400 text-purple-400 bg-purple-900',
        EventType::SOCIAL->value        => 'border-pink-400 text-pink-400 bg-pink-900',
        EventType::WAITT->value         => 'border-indigo-400 text-indigo-400 bg-indigo-900',
        EventType::HACKATHON->value     => 'border-red-400 text-red-400 bg-red-900',
        EventType::TRIP->value          => 'border-emerald-400 text-emerald-400 bg-emerald-900',
        EventType::OTHER->value         => 'border-gray-400 text-gray-400 bg-gray-800',
    ];

    $theme = $colors[$color ?? 'neutral'];
@endphp

<span
    class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $theme }}">
    {{ $label ?? 'Badge' }}
</span>
