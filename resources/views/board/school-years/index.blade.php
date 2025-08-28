@php use App\Models\SchoolYear;@endphp
<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-3xl md:text-5xl font-bayon text-white">School years</h1>
        @can('create',  SchoolYear::class)
            <x-hw.button-link href="{{ route('school-years.create') }}" class="inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="h-5 md:mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="hidden md:inline">New school year</span>
            </x-hw.button-link>
        @endcan
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 pt-5">
            <x-hw.card
                label="Current school year"
                :value="optional($currentSchoolYear)->years ?? 'Not created'"
                color="green"
            />
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700 hidden md:block">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold w-1/5">School year</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Start date</th>
                        <th class="px-4 py-2 font-semibold w-1/5">End date</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Chairman</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Actions</th>
                    </tr>
                </x-slot:head>

                <x-slot:body>
                    @foreach($schoolYears as $schoolYear)
                        <tr class="hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $schoolYear->years }}</td>
                            <td class="px-4 py-4">{{ \Carbon\Carbon::parse($schoolYear->start_academic_year)->toDateString() }}</td>
                            <td class="px-4 py-4">{{ \Carbon\Carbon::parse($schoolYear->end_academic_year)->toDateString() }}</td>
                            <td class="px-4 py-4 capitalize">{{ $schoolYear->name_of_chairman }}</td>
                            <td class="px-4 py-4">
                                <div class="flex gap-x-3">
                                    @can('view', $schoolYear)
                                        <livewire:school-years.preview-modal :$schoolYear/>
                                    @endcan
                                    @can('update', $schoolYear)
                                        <a href="{{route('school-years.edit', $schoolYear)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('delete', $schoolYear)
                                        <livewire:delete-modal :key="$schoolYear->id" :model="$schoolYear"
                                                               :route="'school-years.destroy'"/>
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
                @forelse($schoolYears as $schoolYear)
                    <div class="bg-neutral-800 rounded-lg p-4 border border-neutral-700">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-white">{{ $schoolYear->years }}</h2>
                        </div>
                        <div class="mt-3 space-y-2 text-sm text-gray-300">
                            <p>
                                <span class="font-medium text-white">Start:</span>
                                {{ \Carbon\Carbon::parse($schoolYear->start_academic_year)->format('d M, Y') }}
                            </p>
                            <p>
                                <span class="font-medium text-white">End:</span>
                                {{ \Carbon\Carbon::parse($schoolYear->end_academic_year)->format('d M, Y') }}
                            </p>
                            <p>
                                <span class="font-medium text-white">Chairman:</span>
                                <span class="capitalize">{{ $schoolYear->name_of_chairman }}</span>
                            </p>
                        </div>
                        <div class="flex gap-x-3 mt-4">
                            @can('view', $schoolYear)
                                <livewire:school-years.preview-modal :$schoolYear/>
                            @endcan

                            @can('update', $schoolYear)
                                <a href="{{ route('school-years.edit', $schoolYear) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="size-5 stroke-hw-blue-200 hover:stroke-hw-blue-400 hover:cursor-pointer transition-all">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                    </svg>
                                </a>
                            @endcan
                            @can('delete', $schoolYear)
                                <livewire:delete-modal :key="$schoolYear->id" :model="$schoolYear" :route="'school-years.destroy'"/>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        No sponsors found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.hub>
