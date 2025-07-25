<x-layouts.hub>
    <h1 class="text-5xl font-bayon text-white pt-5">Edit event</h1>
    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data"
          class="max-w-5xl space-y-6 p-6 pl-0 rounded-lg shadow-md">
        @method('PUT')
        @csrf
        <!-- The form was moved to livewire in order to have easier time generating previews -->
        <livewire:events.form :$event/>
    </form>
</x-layouts.hub>
