@php use App\Helpers\MoneyHelper; @endphp
<div>
    <svg wire:click="show(true)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor"
         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
    </svg>

    <x-hw.modal wire:model="showModal" maxWidth="3xl">
        <x-slot name="title">
            Payment preview
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                    <span class="text-neutral-300">User</span>
                    <span class="text-gray-200 font-medium">{{ Auth::user()->name  }}</span>
                </div>

                <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                    <span class="text-neutral-300">Description</span>
                    <span class="text-gray-200 font-medium">{{ $payment->description }}</span>
                </div>

                <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                    <span class="text-neutral-300">Valid until</span>
                    @if($payment->meta->membership_type == 'semester')
                        <span
                            class="text-gray-200 font-medium">{{ $payment->meta->semester == 1 ? $schoolYear->start_second_semester->format('m-d-Y') : $schoolYear->end_academic_year }}</span>
                    @else
                        <span class="text-gray-200 font-medium">{{ $schoolYear->end_academic_year }}</span>
                    @endif
                </div>

                <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                    <span class="text-neutral-300">Amount</span>
                    <span class="text-green-400 font-semibold text-2xl">
                            € {{ MoneyHelper::toDecimal($payment->amount) }}
                        </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-neutral-300">Status</span>
                    <x-hw.badge :label="$payment->status" :color="$payment->status"/>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-hw.button type="button" wire:click="show(false)" class="mr-2">
                Cancel
            </x-hw.button>
        </x-slot>
    </x-hw.modal>
</div>
