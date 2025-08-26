<div>
    <div wire:click="show(true)" class="hover:cursor-pointer">
        @if($event->poster_path)
            <img src="{{asset('storage/' . $event->poster_path)}}" class="object-cover h-90 rounded-xl w-full" alt="Event poster"/>
        @else
            <div class="h-96 w-full bg-hw-blue-500 hover:bg-hw-blue-600 transition-colors text-white rounded-xl text-center">
                <div class="h-full flex justify-center items-center font-bayon text-3xl text-wrap">
                    {{$event->name}}
                </div>
            </div>
        @endif
    </div>

    <x-hw.modal wire:model="showModal" maxWidth="3xl">
        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
            <x-next-event-card :event="$event" :isModal="true" :link="$route"/>
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-hw.modal>
</div>
