@php use App\Models\Sponsor; @endphp
<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-5xl font-bayon text-white">Sponsorships</h1>
        @can('create',  Sponsor::class)
            <x-hw.button-link href="{{ route('sponsors.create') }}">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-5 pr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    New sponsor
                </div>
            </x-hw.button-link>
        @endcan
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
                        <th class="px-4 py-2 font-semibold">Website</th>
                        <th class="px-4 py-2 font-semibold">Tier</th>
                        <th class="px-4 py-2 font-semibold">Actions</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @foreach($sponsors as $sponsor)
                        <tr class="hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $sponsor->name }}</td>
                            <td class="px-4 py-4 ">
                                <a class="flex items-center gap-x-2 text-hw-blue-200 hover:text-hw-blue-400 transition" href="{{ 'https://' . $sponsor->website }}">
                                    Go to website
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </td>
                            <td class="px-4 py-4">
                                <x-hw.badge :label="$sponsor->tier" :color="$sponsor->tier"/>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-x-3">
                                    @can('update', $sponsor)
                                        <a href="{{route('sponsors.edit', $sponsor)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('delete', $sponsor)
                                        <livewire:delete-modal :key="$sponsor->id" :model="$sponsor" :route="'sponsors.destroy'"/>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>
            </x-hw.table>
        </div>
    </div>
</x-layouts.hub>
