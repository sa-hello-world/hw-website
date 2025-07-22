<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-5xl font-bayon text-white">Sponsorships</h1>
        <x-hw.button-link href="{{ route('sponsors.create') }}">
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 pr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New sponsor
            </div>
        </x-hw.button-link>
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 pt-5">
            @foreach($sponsorCounts as $tier => $count)
                <x-hw.card
                    :label="ucfirst($tier) . ' Sponsors'"
                    :value="$count"
                    :color="$tier"
                />
            @endforeach
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold">Sponsor name</th>
                        <th class="px-4 py-2 font-semibold">Tier</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @foreach($sponsors as $sponsor)
                        <tr class="hover:cursor-pointer hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $sponsor->name }}</td>
                            <td class="px-4 py-4">
                                <x-hw.badge :label="$sponsor->tier" :color="$sponsor->tier"/>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>
            </x-hw.table>
        </div>
    </div>
</x-layouts.hub>
