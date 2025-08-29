<x-layouts.app :title="'Events'">
    <div class="flex h-full w-full flex-col text-hw-dark bg-hw-dark md:px-20 px-0">
        <h1 class="text-white font-bayon text-5xl my-6 px-6 lg:px-0">Events</h1>
        @if($nextEvent)
            <h2 class="text-white font-bayon text-5xl my-6 px-6 lg:px-0">Next event</h2>
            @php

            @endphp
            <x-next-event-card :event="$nextEvent" :link="$route"/>
        @endif
        @if(count($nextEvents) > 0)
            <h2 class="text-white font-bayon text-5xl mt-6">All future events</h2>
            <h3 class="text-white font-handwriting text-3xl">Reserve your spot <span class="text-pink-500">early!</span></h3>
            <div class="grid-cols-1 lg:grid-cols-4 gap-4 inline-grid py-5">
                @foreach($nextEvents as $event)
                    <div class="w-full col-span-1">
                        <livewire:events.sign-up-modal :event="$event"/>
                    </div>
                @endforeach
            </div>
        @endif
        @if(count($pastEvents) > 0)
            <h2 class="text-white font-bayon text-5xl mt-6">Past events</h2>
            <div class="grid-cols-1 lg:grid-cols-4 gap-4 inline-grid py-5">
                @foreach($pastEvents as $event)
                    <div class="w-full col-span-1">
                        <livewire:events.sign-up-modal :event="$event"/>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
