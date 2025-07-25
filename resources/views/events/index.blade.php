@php use App\Models\Event;use Carbon\Carbon; @endphp
<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-5xl font-bayon text-white">Events</h1>
        @can('create',  Event::class)
            <x-hw.button-link href="{{ route('events.create') }}">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-5 pr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    New event
                </div>
            </x-hw.button-link>
        @endcan
    </div>
    <h1 class="text-3xl font-bayon text-white">Current academic year</h1>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 pt-5">
            <x-hw.card
                label="Number of events for the academic year"
                :value="$currentSchoolYearEventsCount"
                color="green"
            />
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold w-1/5">Event</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Date</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Type</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Tier</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Actions</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @foreach($currentSchoolYearEvents as $event)
                        <tr class="hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $event->name }}</td>
                            <td class="px-4 py-4 capitalize">
                                {{ Carbon::parse($event->start)->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-4 py-4 capitalize">{{ str_replace('_', ' ', $event->type)  }}</td>
                            <td class="px-4 py-4">
                                <x-hw.badge :label="$event->status" :color="$event->status"/>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-x-3">
                                    @can('view', $event)
                                        <livewire:events.preview-modal :$event/>
                                    @endcan
                                    @can('update', $event)
                                        <a href="{{route('events.edit', $event)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('delete', $event)
                                        <livewire:delete-modal :key="$event->id" :model="$event"
                                                               :route="'events.destroy'"/>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>
            </x-hw.table>
            <div class="pr-5">
                {{$currentSchoolYearEvents->links('components.pagination')}}
            </div>
        </div>
    </div>
    <h1 class="text-3xl pb-5 pt-10 font-bayon text-white">Archive (Previous academic year)</h1>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold w-1/5">Event</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Date</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Type</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Tier</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Actions</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @forelse($previousSchoolYearEvents as $event)
                        <tr class="hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $event->name }}</td>
                            <td class="px-4 py-4 capitalize">
                                {{ Carbon::parse($event->start)->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-4 py-4 capitalize">{{ str_replace('_', ' ', $event->type)  }}</td>
                            <td class="px-4 py-4">
                                <x-hw.badge :label="$event->status" :color="$event->status"/>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-x-3">
                                    @can('update', $event)
                                        <a href="{{route('events.edit', $event)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('delete', $event)
                                        <livewire:delete-modal :key="$event->id" :model="$event"
                                                               :route="'events.destroy'"/>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">
                                No events/previous academic year found.
                            </td>
                        </tr>
                    @endforelse

                </x-slot:body>
            </x-hw.table>
            <div class="pr-5">
                {{$previousSchoolYearEvents->links('components.pagination')}}
            </div>
        </div>
    </div>
</x-layouts.hub>
