@props(['name', 'label' => null])

<div x-data="{ fileName: '' }" class="flex flex-col space-y-1">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-hw-blue-300">
            {{ $label }}
        </label>
    @endif

    <div
        class="relative flex cursor-pointer items-center rounded border border-hw-blue-600 bg-hw-dark px-4 py-2 text-hw-blue-300 hover:border-hw-blue-400 focus-within:border-hw-blue-400 focus-within:ring focus-within:ring-hw-blue-500 focus-within:ring-opacity-50"
    >
        <svg
            class="mr-2 h-5 w-5 text-hw-blue-400"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v6m0 0l-3-3m3 3l3-3M12 6v6" />
        </svg>

        <span x-text="fileName || 'No file selected'" class="truncate text-sm"></span>

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="file"
            accept="image/*"
            class="absolute inset-0 opacity-0 cursor-pointer"
            @change="fileName = $event.target.files.length ? $event.target.files[0].name : ''"
        />
    </div>

    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
