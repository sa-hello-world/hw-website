@props(['sponsors'])

<section class="px-0">
    <h2 class="text-white text-4xl md:text-5xl font-bayon mb-6 px-6 md:px-20">
        Thank you to our Sponsors!
    </h2>

    <div class="relative bg-white px-6 md:px-20 py-12">
        @if(count($sponsors) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($sponsors as $sponsor)
                    <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow">
                        <img src="{{ asset('storage/' . $sponsor->image_path) }}"
                             alt="{{ $sponsor->name }}"
                             class="max-h-16 object-contain"/>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" class="max-h-16 object-contain"/>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-xl text-gray-700 font-semibold">
                Waiting for sponsors!
            </div>
        @endif

        <!-- Mascot -->
        <img src="{{ asset('/img/main_logo_planet.png') }}"
             alt="Mascot"
             class="hidden md:block absolute bottom-0 right-6 w-64 h-auto pointer-events-none select-none"/>
    </div>
</section>
