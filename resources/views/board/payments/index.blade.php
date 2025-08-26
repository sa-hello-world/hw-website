@php use App\Models\SchoolYear;@endphp
<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-5xl font-bayon text-white">Payments</h1>
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 pt-5">
            <x-hw.card
                label="Open payments"
                :value="$openPaymentsCount"
                color="warning"
            />
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700">
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
    </div>
</x-layouts.hub>
