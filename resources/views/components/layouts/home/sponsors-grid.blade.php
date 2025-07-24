@props(['sponsors'])

<section class="px-0">
    <h2 class="text-gray-50 text-4xl md:text-5xl font-bayon mb-6 px-6 md:px-20">
        Thank you to our Sponsors!
    </h2>

    <div class="relative bg-gray-50 px-6 md:px-20 py-12 space-y-12">

        {{-- Gold Sponsors --}}
        @if($sponsors->where('tier', 'gold')->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors->where('tier', 'gold') as $sponsor)
                    <div class="w-fit h-20">
                        <img src="{{ asset('storage/' . $sponsor->logo_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="w-full  object-contain" />
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Silver Sponsors --}}
        @if($sponsors->where('tier', 'silver')->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors->where('tier', 'silver') as $sponsor)
                    <div class="w-fit h-16">
                        <img src="{{ asset('storage/' . $sponsor->logo_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="w-full h-16 object-contain" />
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bronze Sponsors --}}
        @if($sponsors->where('tier', 'bronze')->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors->where('tier', 'bronze') as $sponsor)
                    <div class="w-fit h-12">
                        <img src="{{ asset('storage/' . $sponsor->logo_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="w-full h-12 object-contain" />
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Mascot -->
        <img src="{{ asset('/img/main_logo_planet.png') }}"
             alt="Mascot"
             class="hidden md:block absolute bottom-0 right-6 w-64 h-auto pointer-events-none select-none"/>
    </div>
</section>
