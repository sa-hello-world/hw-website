<div>
    <svg wire:click="show(true)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor"
         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"  />
    </svg>

    <x-hw.modal wire:model="showModal" maxWidth="lg">
        <x-slot name="title">
            @if($user->is_board_member)
                Remove {{$user->name}}  current board member?
            @else
                Mark {{$user->name}} as a current board member?
            @endif
        </x-slot>

        <x-slot name="content">
            @if(!$user->is_board_member)
                This setting indicates in what capacity is {{$user->name}} in the current board.

                <select name="board_role" id="board_role" required wire:model="board_role"
                        class="w-full mt-2 p-2 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs">
                    @foreach($boardRoles as $role)
                        <option value="{{$role}}">
                            {{ucfirst($role)}}
                        </option>
                    @endforeach
                </select>
            @else
                Revoke all roles and permissions in relation to the current board from {{$user->name}}
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-hw.button type="button" wire:click="show(false)" class="mr-2">
                Cancel
            </x-hw.button>

            <x-hw.button wire:click="save" variant="{{$user->is_board_member ? 'danger' : 'success'}}">
                @if($user->is_board_member)
                    Remove as a board member
                @else
                    Mark as a board member
                @endif
            </x-hw.button>
        </x-slot>
    </x-hw.modal>
</div>
