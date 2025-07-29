<x-layouts.hub>

<div class="min-h-screen bg-gray-900 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-700">
                <!-- Payment Heading -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-white">Review Your Payment</h1>
                    <p class="text-gray-400 mt-2">Please confirm the details before proceeding to Mollie.</p>
                </div>

                <!-- Payment Info Card -->
                <div class="bg-gray-900 rounded-xl p-5 border border-gray-700 mb-6">
                    <div class="flex justify-between mb-3">
                        <span class="text-gray-400">Description</span>
                        <span class="text-gray-200 font-medium">{{ $payment->description }}</span>
                    </div>
                    <div class="flex justify-between mb-3">
                        <span class="text-gray-400">Amount</span>
                        <span class="text-green-400 font-semibold text-lg">
                        € {{ number_format($payment->amount, 2) }}
                    </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status</span>
                        <span class="px-3 py-1 text-sm rounded-full
                        @if($payment->status === 'pending') bg-yellow-500/20 text-yellow-400
                        @elseif($payment->status === 'failed') bg-red-500/20 text-red-400
                        @else bg-green-500/20 text-green-400 @endif">
                        {{ ucfirst($payment->status) }}
                    </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <a href="{{ route('payments.cancel', $payment) }}"
                       class="w-1/2 text-center py-3 rounded-xl border border-gray-600 text-gray-300 hover:bg-gray-700 transition">
                        Cancel
                    </a>

                    <form method="POST" action="{{ route('payments.proceed', $payment) }}" class="w-1/2">
                        @csrf
                        <button type="submit"
                                class="w-full py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-500 transition shadow-md shadow-blue-500/20">
                            Proceed to Mollie
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.hub>
