<div>
    <svg wire:click="show(true)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor"
         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
    </svg>

    <x-hw.modal wire:model="showModal" maxWidth="3xl">
        <x-slot name="title">
            Event preview
        </x-slot>

        <x-slot name="content">
            <div class="h-[72vh]">
                <x-next-event-card :event="$event"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-hw.button type="button" wire:click="show(false)" class="mr-2">
                Cancel
            </x-hw.button>
        </x-slot>
    </x-hw.modal>
</div>
