@props(['sponsors'])

<section class="px-0">
    <h2 class="text-white text-4xl md:text-5xl font-bayon mb-6 px-6 md:px-20">
        Thank you to our Sponsors!
    </h2>

    <div class="relative bg-white px-6 md:px-20 py-12 space-y-12">

        {{-- Gold Sponsors --}}
        @if($sponsors->where('tier', 'gold')->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors->where('tier', 'gold') as $sponsor)
                    <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow h-24">
                        <img src="{{ asset('storage/' . $sponsor->image_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="w-full  object-contain" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" class="max-h-16 object-contain"/>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Silver Sponsors --}}
        @if($sponsors->where('tier', 'silver')->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors->where('tier', 'silver') as $sponsor)
                    <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow h-16">
                        <img src="{{ asset('storage/' . $sponsor->image_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="w-full h-16 object-contain" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" class="max-h-16 object-contain"/>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bronze Sponsors --}}
        @if($sponsors->where('tier', 'bronze')->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors->where('tier', 'bronze') as $sponsor)
                    <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow h-12">
                        <img src="{{ asset('storage/' . $sponsor->image_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="w-full h-12 object-contain" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" class="max-h-16 object-contain"/>
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
