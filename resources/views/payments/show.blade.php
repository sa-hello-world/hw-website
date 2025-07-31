@php use App\Helpers\MoneyHelper;use Illuminate\Support\Facades\Auth; @endphp
<x-layouts.hub>
    <div class="h-full py-5">
        <h1 class="text-3xl font-bold text-white mb-2">Payment #{{$payment->id}}</h1>
        <p class="text-gray-400 mb-8">Here you can find details regarding your payment.</p>

        <div class="max-w-3xl space-y-8">
            <div class="bg-hw-black rounded-2xl shadow-lg border border-neutral-500 bg-neutral-500/5 p-8">
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
                        <span class="text-neutral-300">Amount</span>
                        <span class="text-green-400 font-semibold text-2xl">
                            € {{ MoneyHelper::toDecimal($payment->amount) }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-neutral-300">Status</span>
                        <span class="px-4 py-1 text-sm rounded-full
                            @if($payment->status === 'pending') bg-yellow-500/20 text-yellow-400
                            @elseif($payment->status === 'failed') bg-red-500/20 text-red-400
                            @else bg-green-500/20 text-green-400 @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.hub>
