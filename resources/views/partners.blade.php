<x-layouts.app :title="'Sponsors & Partners'">
    <div class="flex h-full w-full flex-col text-hw-dark bg-hw-dark md:px-20 px-0">
        <h1 class="text-white font-bayon text-5xl my-6 px-6 lg:px-0">Our partners</h1>

        @if(count($sponsors) > 0)
            @foreach($tiers as $tier => $group)
                <h2 class="text-white font-bayon text-4xl mt-6 capitalize">
                    {{ $tier }} Sponsors
                </h2>
                <div class="grid-cols-2 md:grid-cols-4 gap-6 inline-grid py-5">
                    @foreach($group as $sponsor)
                        <div class="w-full col-span-1 flex flex-col items-center">
                            <div class="border {{$tierColors[strtolower($sponsor->tier)] ?? 'border-hw-blue-100'}} w-full h-40 flex items-center justify-center rounded-lg p-4">
                                @if($sponsor->website)
                                    <a href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer" class="w-full h-full flex items-center justify-center">
                                        @if($sponsor->logo_path)
                                            <img src="{{ asset('storage/' . $sponsor->logo_path) }}"
                                                 alt="{{ $sponsor->name }} logo"
                                                 class="max-h-32 object-contain">
                                        @else
                                            <span class="text-gray-100 font-bayon text-4xl text-wrap text-center">
                                                {{ $sponsor->name }}
                                            </span>
                                        @endif
                                    </a>
                                @else
                                    @if($sponsor->logo_path)
                                        <img src="{{ asset('storage/' . $sponsor->logo_path) }}"
                                             alt="{{ $sponsor->name }} logo"
                                             class="max-h-32 object-contain">
                                    @else
                                        <span class="text-gray-100 font-bayon text-4xl text-wrap text-center">
                                            {{ $sponsor->name }}
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p class="text-white font-handwriting text-2xl mt-6">
                No sponsors yet — check back soon!
            </p>
        @endif
    </div>
</x-layouts.app>
