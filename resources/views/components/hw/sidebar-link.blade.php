@php
    $isCurrentRoute = empty($param) ? request()->routeIs($route) : (
        request()->routeIs($route) &&
        (request()->route()->parameter('type') == $param || request()->route()->parameter('team') == $param || request()->route()->parameter('presentation')->id == $param->id)
    );

    $bgColorClass = $isCurrentRoute ? 'bg-neutral-900 text-gray-300 stroke-gray-300' : 'hover:bg-neutral-900 hover:cursor-pointer transition-all text-gray-300 stroke-gray-300';
@endphp
    <!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-500 text-participant-500 text-partner-500 stroke-crew-500 stroke-participant-500 stroke-partner-500 -->
<!-- dark:text-crew-500 dark:text-participant-500 dark:text-partner-500 hover:text-crew-500 hover:text-participant-500 hover:text-partner-500 dark:hover:text-crew-500 dark:hover:text-participant-500 dark:hover:text-partner-500 -->

<li class="m-1">
    @if($type == "form")
        <form method="POST" action="{{ route($route) }}">
            @csrf
            <button type="submit" class="w-full leading-6 font-semibold text-sm py-1.5 px-4 rounded-md gap-x-3 flex items-center {{ $bgColorClass }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" class="w-4.5 h-4.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="{{ $icon }}">
                    </path>
                    @if($label == 'Edit profile')
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    @endif
                </svg>
                <span class="hidden lg:block">{{$label}}</span>
            </button>

        </form>
    @else
        <a href="{{ empty($param) ? route($route) : route($route, $param) }}" wire:navigate.hover
           class="leading-6 font-semibold text-sm py-1.5 px-4 rounded-md gap-x-3 flex items-center {{ $bgColorClass }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true" class="w-4.5 h-4.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="{{ $icon }}">
                </path>
                @if($label == 'Edit profile')
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                @endif
            </svg>
            <span class="hidden lg:block">{{$label}}</span>
        </a>
    @endif
</li>
