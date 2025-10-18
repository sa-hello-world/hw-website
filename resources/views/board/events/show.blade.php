@php use App\Helpers\MoneyHelper;use Illuminate\Support\Facades\Auth; @endphp

<x-layouts.hub>
    <div class="h-full py-5">
        <h1 class="text-3xl md:text-5xl font-bayon text-white mb-2">Event: {{ $event->name }}</h1>
        <p class="text-md md:text-xl text-hw-blue-400 mb-8">Here you can find details regarding this event.</p>
        <div class="max-w-3xl space-y-8">
            <h1 class="text-xl md:text-3xl font-bayon text-white mb-2">Details</h1>
            <div class="bg-hw-black rounded-2xl shadow-lg border border-neutral-500 bg-neutral-500/5 p-8">
                <div class="space-y-6">
                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Title</span>
                        <span class="text-gray-200 font-medium text-right">
                            {{ $event->name }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Description</span>
                        <span class="text-gray-200 font-medium text-right">
                            {{ $event->description }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Location</span>
                        <span class="text-gray-200 font-medium">{{ $event->location }}</span>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Start</span>
                        <span class="text-gray-200 font-medium">
                            {{ \Illuminate\Support\Carbon::parse($event->start)->format('d-m-Y H:i') }}
                        </span>
                    </div>

                    @if($event->end)
                        <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                            <span class="text-neutral-300">End</span>
                            <span class="text-gray-200 font-medium">
                                {{ $event->end->format('m-d-Y H:i') }}
                            </span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Type</span>
                        <x-hw.badge :label="$event->type" :color="$event->type"/>
                    </div>

                    <div class="flex justify-between items-center border-b border-neutral-700 pb-4">
                        <span class="text-neutral-300">Regular price</span>
                        <span class="text-gray-200 font-medium">
                            {{$event->regular_price ? '€ ' . MoneyHelper::toDecimal($event->regular_price) : 'Free!'}}
                        </span>
                    </div>

                    <div class="flex justify-between items-center pb-4">
                        <span class="text-neutral-300">Member price</span>
                        <span class="text-gray-200 font-medium">
                            {{$event->member_price ? '€ ' . MoneyHelper::toDecimal($event->member_price) : 'Free!'}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-3xl space-y-8 mt-12">
            <h1 class="text-xl md:text-3xl font-bayon text-white mb-2">Participants ({{count($event->users)}})</h1>

            <div class="space-y-4">
                @forelse($event->users as $participant)
                    <div class="bg-neutral-900 rounded-lg p-4 border border-neutral-700">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-white">{{ $participant->name }}</h2>
                            <span class="text-sm text-gray-400">
                                {{ $participant->eventUsers->where('user_id', $participant->id)->first()->created_at->format('d M Y H:i') }}
                            </span>
                        </div>

                        <div class="mt-2 flex justify-between items-center">
                            <p class="text-gray-300 text-sm">{{ $participant->email }}</p>
                            <p class="text-sm {{$participant->is_member ? 'text-hw-blue' : 'text-gray-400'}}">{{ $participant->is_member ? 'Membership' : 'Regular'}}</p>
                        </div>

                        @can('view', $participant)
                            <div class="flex gap-x-3 mt-3">
                                <a href="{{ route('users.show', $participant) }}"
                                   class="text-hw-blue-200 hover:text-hw-blue-400 text-sm font-medium transition">
                                    View profile →
                                </a>
                            </div>
                        @endcan
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        No participants yet.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-layouts.hub>
