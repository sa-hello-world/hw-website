<x-layouts.hub>
    <div class="flex items-center justify-between py-5">
        <h1 class="text-5xl font-bayon text-white">Payments</h1>
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
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
                                      <a href="{{route('payments.show', $payment)}}">
                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                               stroke-width="1.5" stroke="currentColor"
                                               class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                              <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                          </svg>
                                      </a>
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
