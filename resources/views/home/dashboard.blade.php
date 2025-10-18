<x-layouts.hub>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if(!$user->is_member)
            <x-hw.membership-banner/>
        @endif
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @if(!is_null($currentYearAttended))
                <x-hw.card
                    label="Attended events this year"
                    :value="$currentYearAttended"
                    color="blue"
                />
            @endif
            <x-hw.card
                label="Total attended events"
                :value="$totalEventsAttended"
                color="neutral"
            />
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl">
            <h1 class="text-3xl md:text-5xl font-bayon text-white py-5">Upcoming Events</h1>
            <div class="w-full grid grid-cols-3 gap-3">
                @if($nextEvent)
                    <div class="col-span-2 h-full">
                        <x-next-event-card :event="$nextEvent" :link="$route"/>
                    </div>
                @endif
                <div class="flex flex-col gap-3 ">
                    @foreach($nextEvents as $event)
                        @if($event->banner_path)
                            <img src="{{ asset('storage/' . $event->banner_path) }}"
                                 class="w-full h-20 rounded-3xl object-cover"/>
                        @else
                            <div
                                class="w-full h-20 text-center flex justify-center items-center text-white bg-hw-blue rounded-3xl">
                                {{$event->name}}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.hub>
