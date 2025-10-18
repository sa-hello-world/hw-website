@php use App\Models\SchoolYear;@endphp
<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-3xl md:text-5xl font-bayon text-white">Payments</h1>
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 pt-5">
            <x-hw.card
                label="Open payments"
                :value="$openPaymentsCount"
                color="warning"
            />
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700 hidden md:block">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold w-1/5">Description</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Type</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Status</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Created At</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Actions</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @forelse($payments as $payment)
                        <tr class="hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $payment->description }}</td>
                            <td class="px-4 py-4">
                                <x-hw.badge :label="$payment->meta->payable_type" :color="$payment->meta->payable_type"/>
                            </td>
                            <td class="px-4 py-4 capitalize">
                                <x-hw.badge :label="$payment->status" :color="$payment->status"/>
                            </td>
                            <td class="px-4 py-4">{{ \Carbon\Carbon::parse($payment->created_at)->toDateString() }}</td>
                            <td class="px-4 py-4">
                              <div class="flex gap-x-3">
                                  @can('view', $payment)
                                      <livewire:payments.preview-modal :$payment/>
                                  @endcan
                              </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">
                                No payments found.
                            </td>
                        </tr>
                    @endforelse
                </x-slot:body>
            </x-hw.table>
        </div>
        <div class="md:hidden">
            <div class="space-y-4">
                @forelse($payments as $payment)
                    <div class="bg-neutral-800 rounded-lg p-4 border border-neutral-700">
                        {{-- Header --}}
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-white capitalize">{{ $payment->description }}</h2>
                            <x-hw.badge :label="$payment->status" :color="$payment->status"/>
                        </div>

                        {{-- Details --}}
                        <div class="mt-3 space-y-2 text-sm text-gray-300">
                            <p>
                                <span class="font-medium text-white">Type:</span>
                                {{ ucfirst($payment->meta->payable_type) }}
                            </p>
                            <p>
                                <span class="font-medium text-white">Created:</span>
                                {{ \Carbon\Carbon::parse($payment->created_at)->format('M d, Y') }}
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-x-3 mt-4">
                            @can('view', $payment)
                                <livewire:payments.preview-modal :$payment/>
                            @endcan

                            @can('update', $payment)
                                <a href="{{ route('payments.edit', $payment) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                    </svg>
                                </a>
                            @endcan

                            @can('delete', $payment)
                                <livewire:delete-modal :key="$payment->id" :model="$payment" :route="'payments.destroy'"/>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        No payments found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.hub>
