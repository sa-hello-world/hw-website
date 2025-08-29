<div>
    <svg wire:click="show(true)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor"
         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
    </svg>

    <x-hw.modal wire:model="showModal" maxWidth="lg">
        <x-slot name="title">
            Mark {{$user->name}} as a board member?
        </x-slot>

        <x-slot name="content">
            When you mark user as a board member (does not matter if it is current board, or a past one) they gain a membership for life.
        </x-slot>

        <x-slot name="footer">
            <x-hw.button type="button" wire:click="show(false)" class="mr-2">
                Cancel
            </x-hw.button>

            <x-hw.button wire:click="markAsBoardMember" variant="success">
                Mark as board member
            </x-hw.button>
        </x-slot>
    </x-hw.modal>
</div>
