@php use App\Helpers\MoneyHelper;use Illuminate\Support\Facades\Auth; @endphp

<x-layouts.hub>
    <div class="h-full py-5">
        <h1 class="text-5xl font-bayon text-white mb-2">Event: {{ $event->name }}</h1>
        <p class="text-xl text-hw-blue-400 mb-8">Here you can find details regarding this event.</p>

        <div class="max-w-3xl space-y-8">
            <div class="bg-hw-black rounded-2xl shadow-lg border border-neutral-500 bg-neutral-500/5 p-8">
                <div class="space-y-6">
                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Title</span>
                        <span class="text-gray-200 font-medium text-right">
                            {{ $event->name }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Description</span>
                        <span class="text-gray-200 font-medium text-right">
                            {{ $event->description }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Location</span>
                        <span class="text-gray-200 font-medium">{{ $event->location }}</span>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Start</span>
                        <span class="text-gray-200 font-medium">
                            {{ \Illuminate\Support\Carbon::parse($event->start)->format('d-m-Y H:i') }}
                        </span>
                    </div>

                    @if($event->end)
                        <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                            <span class="text-neutral-300">End</span>
                            <span class="text-gray-200 font-medium">
                                {{ $event->end->format('m-d-Y H:i') }}
                            </span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Type</span>
                        <x-hw.badge :label="$event->type" :color="$event->type"/>
                    </div>

                    @if($payment)
                        <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                            <span class="text-neutral-300">Payment</span>
                            <a href="{{route('payments.show', $payment)}}"
                               class="text-hw-blue-400 text-lg underline hover:text-hw-blue-600 transition-colors">
                                Go to payment
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.hub>
