@props(['events'])

<section class="p-20">
    <h2 class="text-hw-blue text-4xl font-title mb-6">Upcoming Events</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($events as $event)
            <div class="rounded-xl border p-4 shadow hover:shadow-lg transition">
                <h3 class="font-title text-xl text-hw-dark dark:text-white">{{ $event->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $event->description }}</p>
                <p class="text-xs mt-2 text-gray-400">{{ $event->date->format('F j, Y') }}</p>
            </div>
        @endforeach
    </div>
</section>
