@props(['events'])

<section class="md:px-20 px-6">
    <h2 class="text-white font-bayon text-5xl mb-6">Some of our last events</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($events as $event)
            <div class="rounded-xl border p-4 shadow hover:shadow-lg transition">
                <h3 class="text-white font-title text-xl">{{ $event->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $event->description }}</p>
                <p class="text-xs mt-2 text-gray-400">{{ \Carbon\Carbon::parse($event->start)->format('F j, Y') }}</p>

                <img src="https://placehold.co/400x200?text=Event+Image" alt="Event Image" class="w-full rounded-lg mt-2">
            </div>
        @endforeach
    </div>
</section>
