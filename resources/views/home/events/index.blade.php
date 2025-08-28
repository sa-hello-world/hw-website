@php use Carbon\Carbon; @endphp
<x-layouts.hub>
    <div class="py-5">
        <h1 class="text-3xl md:text-5xl font-bayon text-white">My Events</h1>
        <p class="text-md md:text-xl text-hw-blue-400">Here you can see the events you signed up for!</p>
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700 hidden md:table">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold w-1/5">Event</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Date</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Type</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Status</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Actions</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @foreach($events as $event)
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
                                        <a href="{{route('my.events.show', $event)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                        </a>                                    @endcan
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
        </div>
        <div class="md:hidden">
            <div class="space-y-4">
                @forelse($events as $event)
                    <div class="bg-neutral-800 rounded-lg p-4 border border-neutral-700">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-white">{{ $event->name }}</h2>
                            <x-hw.badge :label="$event->status" :color="$event->status"/>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">
                            {{ Carbon::parse($event->start)->format('Y-m-d H:i') }}
                        </p>
                        <p class="text-sm capitalize text-gray-300">{{ str_replace('_', ' ', $event->type) }}</p>

                        <div class="flex gap-x-3 mt-3">
                            @can('view', $event)
                                <a href="{{route('my.events.show', $event)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </a>
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
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        No events/previous academic year found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.hub>
