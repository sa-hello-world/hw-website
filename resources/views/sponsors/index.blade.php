<x-layouts.hub>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 pt-5">
            @foreach($sponsorCounts as $tier => $count)
                <x-hw.card
                    :label="ucfirst($tier) . ' Sponsors'"
                    :value="$count"
                    :color="$tier"
                />
            @endforeach
        </div>
        <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700">
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
