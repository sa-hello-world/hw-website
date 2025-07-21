<div class="bg-hwblack px-6 py-12">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-white text-3xl font-bold font-title text-center mb-12 uppercase">
            SOME OF OUR LAST EVENTS
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="relative overflow-hidden rounded-lg group cursor-pointer">
                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}"
                         class="w-full h-64 object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-white font-bold text-xl mb-2">{{ $event['title'] }}</h3>
                        @if(isset($event['subtitle']))
                            <p class="text-gray-300 text-sm">{{ $event['subtitle'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
