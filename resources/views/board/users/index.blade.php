@php use App\Models\User; @endphp
<x-layouts.hub>
    <div class="flex items-center justify-between pt-5">
        <h1 class="text-3xl md:text-5xl font-bayon text-white">Users</h1>
    </div>
    <div class="grid auto-rows-min gap-4 md:grid-cols-3 py-5">
        <x-hw.card
            label="Total users"
            :value="$totalUserCount"
            color="neutral"
        />
        @if($currentSchoolYear)
            <x-hw.card
                label="Members for academic year {{$currentSchoolYear->years}}"
                :value="$membersCount"
                color="green"
            />
        @endif
    </div>
    <div class="flex w-full flex-1 flex-col gap-4 rounded">
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-500 dark:border-neutral-700 hidden md:block">
            <x-hw.table>
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-2 font-semibold w-1/5">Name</th>
                        <th class="px-4 py-2 font-semibold w-1/5">Email</th>
                        <th class="px-4 py-2 font-semibold w-1/5"></th>
                        <th class="px-4 py-2 font-semibold w-1/5">Registration date</th>
                    </tr>
                </x-slot:head>
                <x-slot:body>
                    @forelse($users as $user)
                        <tr class="hover:bg-neutral-900 transition-all">
                            <td class="px-4 py-4 capitalize">{{ $user->name }}</td>
                            <td class="px-4 py-4">{{ $user->email }}</td>
                            <td class="px-4 py-4 capitalize">
                                @if($user->is_member)
                                    <x-hw.badge label="Member" color="success"/>
                                @endif
                            </td>
                            <td class="px-4 py-4 capitalize">
                                {{ $user->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </x-slot:body>
            </x-hw.table>
            <div class="pr-5">
                {{$users->links('components.pagination')}}
            </div>
        </div>

        <div class="md:hidden">
            <div class="space-y-4">
                @forelse($users as $user)
                    <div class="bg-neutral-800 rounded-lg p-4 border border-neutral-700">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-white capitalize">{{ $user->name }}</h2>
                        </div>
                        <div class="mt-3 space-y-2 text-sm text-gray-300">
                            <p>
                                <span class="font-medium text-white">Email:</span>
                                {{ $user->email }}
                            </p>
                            <p>
                                @if($user->is_member)
                                    <x-hw.badge label="Member" color="success"/>
                                @endif
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        No users found.
                    </div>
                @endforelse
            </div>
            <div class="flex justify-center items-center">
                {{$users->links('components.pagination')}}
            </div>
        </div>
    </div>
</x-layouts.hub>
