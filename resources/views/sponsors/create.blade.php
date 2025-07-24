@php use App\Enums\SponsorshipTier; @endphp
<x-layouts.hub>
    <h1 class="text-5xl font-bayon text-white pt-5">Add a new sponsor</h1>
    <form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data"
          class="max-w-lg space-y-6 p-6 pl-0 rounded-lg shadow-md">
        @csrf

        <div>
            <x-hw.label for="name" value="Sponsor name"/>
            <x-hw.input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                required
            />
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="tier" value="Tier"/>
            <select
                name="tier"
                id="tier"
                required
                class="w-full p-2 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs"
            >
                <option value="" disabled {{ old('tier') ? '' : 'selected' }}>Select tier</option>
                @foreach(SponsorshipTier::cases() as $tier)
                    <option value="{{ $tier->value }}" {{ old('tier') === $tier->value ? 'selected' : '' }}>
                        {{ ucfirst($tier->value) }}
                    </option>
                @endforeach
            </select>
            @error('tier') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="logo" value="Logo"/>
            <x-hw.file-upload name="logo"/>
        </div>

        <div>
            <x-hw.label for="website" value="Website"/>
            <x-hw.input
                type="text"
                name="website"
                id="website"
                value="{{ old('website') }}"
                placeholder="www.example.com"
                required
            />
            @error('website') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-row-reverse gap-x-2">
            <x-hw.button type="submit" variant="save">
                Create
            </x-hw.button>
            <x-hw.button type="button">
                <a href="{{ url()->previous() }}">Cancel</a>
            </x-hw.button>
        </div>
    </form>
</x-layouts.hub>
