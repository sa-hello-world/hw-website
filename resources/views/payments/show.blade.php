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
                        <span class="text-neutral-300">Valid until</span>
                        @if($payment->meta->membership_type == 'semester')
                            <span class="text-gray-200 font-medium">{{ $payment->meta->semester == 1 ? $schoolYear->start_second_semester->format('m-d-Y') : $schoolYear->end_academic_year }}</span>
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
                        <span class="px-4 py-1 text-sm rounded-full
                            @if($payment->status === 'pending') bg-yellow-500/20 text-yellow-400
                            @elseif($payment->status === 'failed') bg-red-500/20 text-red-400
                            @else bg-green-500/20 text-green-400 @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>
                </div>
            </div>

            @can('pay', $payment)
                <div class="max-w-3xl text-left">
                    <h2 class="text-2xl font-semibold text-white mb-3">Ready to Pay?</h2>
                    <p class="text-gray-400 text-sm mb-6">
                        Double-check your payment details and proceed to Mollie to complete the transaction.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <form action="{{route('payments.cancel', $payment)}}" method="POST">
                            @csrf
                            <button
                                class="flex-1 sm:flex-none sm:w-40 text-center py-3 rounded-xl border border-gray-600 text-gray-300 hover:bg-gray-700 transition">
                                Cancel
                            </button>
                        </form>

                        <form action="{{route('payments.prepare', $payment)}}" method="POST" class="flex-1 sm:flex-none sm:w-40">
                            @csrf
                            <button type="submit"
                                    class="w-full py-3 rounded-xl bg-hw-blue-600 text-white font-medium hover:bg-hw-blue-700 hover:cursor-pointer transition-colors">
                                Pay
                            </button>
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</x-layouts.hub>
