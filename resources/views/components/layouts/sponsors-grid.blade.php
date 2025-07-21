<div class="bg-white px-6 py-12">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-hwblack font-title text-3xl font-bold text-center mb-12 uppercase">
            THANK YOU TO OUR SPONSORS!
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 items-center justify-items-center">
            @foreach($sponsors as $sponsor)
                <div class="flex items-center justify-center p-4">
                    <img src="{{ $sponsor['logo'] }}" alt="{{ $sponsor['name'] }}"
                         class="max-w-full max-h-16 object-contain grayscale hover:grayscale-0 transition-all">
                </div>
            @endforeach
        </div>

        <!-- Mascot in bottom right -->
        <div class="flex justify-end mt-12">
            <img src="{{ asset('/images/main_logo_planet.png') }}" alt="Mascot" class="w-24 h-24 object-contain">
        </div>
    </div>
</div>
