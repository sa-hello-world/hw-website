@props(['sponsors'])

<section class="md:p-20 p-6">
    <h2 class="text-white text-5xl font-bayon mb-6">Thank you to our Sponsors!</h2>
    <div class="bg-white p-12 max-w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @foreach($sponsors as $sponsor)
            <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow">
                <img src="{{ asset('storage/' . $sponsor->image_path) }}"
                     alt="{{ $sponsor->name }}"
                     class="max-h-16 object-contain"/>
            </div>
        @endforeach
        <h1>Waiting for sponsors!</h1>

        <!-- Mascot -->
        <img src="{{ asset('/img/main_logo_planet.png') }}" alt="Mascot" class="w-[420px] mr-0 h-auto pointer-events-none">
    </div>
</section>
