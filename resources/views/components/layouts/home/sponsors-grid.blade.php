@props(['sponsors'])

<section class="p-20">
    <h2 class="text-hw-green text-5xl font-title mb-6">Our Partners</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @foreach($sponsors as $sponsor)
            <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow">
                <img src="{{ asset('storage/' . $sponsor->image_path) }}"
                     alt="{{ $sponsor->name }}"
                     class="max-h-16 object-contain"/>
            </div>
        @endforeach
    </div>
</section>
