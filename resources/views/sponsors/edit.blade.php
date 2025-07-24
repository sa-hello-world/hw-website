@php use App\Enums\SponsorshipTier; @endphp
<x-layouts.hub>
    <h1 class="text-5xl font-bayon text-white pt-5">Edit sponsor</h1>
    <form action="{{ route('sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data"
          class="max-w-lg space-y-6 p-6 pl-0 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div>
            <x-hw.label for="name" value="Sponsor name"/>
            <x-hw.input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $sponsor->name) }}"
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
                <option value="" disabled {{ old('tier', $sponsor->tier) ? '' : 'selected' }}>Select tier</option>
                @foreach(SponsorshipTier::cases() as $tier)
                    <option value="{{ $tier->value }}" {{ old('tier', $sponsor->tier) === $tier->value ? 'selected' : '' }}>
                        {{ ucfirst($tier->value) }}
                    </option>
                @endforeach
            </select>
            @error('tier') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="logo" value="Logo"/>
            <x-hw.file-upload name="logo" id="logo_input"/>
            <div id="current_logo_preview" @if(old('logo')) style="display:none" @endif>
                @if($sponsor->logo_path)
                    <p class="mt-2 text-sm text-gray-400">Current logo:</p>
                    <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="Sponsor logo" class="h-20 mt-1 rounded" />
                @endif
            </div>
        </div>

        <div>
            <x-hw.label for="website" value="Website"/>
            <x-hw.input
                type="text"
                name="website"
                id="website"
                value="{{ old('website', $sponsor->website) }}"
                placeholder="www.example.com"
                required
            />
            @error('website') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-row-reverse gap-x-2">
            <x-hw.button type="submit" variant="save">
                Update
            </x-hw.button>
            <x-hw.button type="button">
                <a href="{{ url()->previous() }}">Cancel</a>
            </x-hw.button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoInput = document.getElementById('logo_input');
            const currentLogoPreview = document.getElementById('current_logo_preview');

            logoInput.addEventListener('change', () => {
                if (logoInput.files.length > 0) {
                    currentLogoPreview.style.display = 'none';
                } else {
                    currentLogoPreview.style.display = '';
                }
            });
        });
    </script>
</x-layouts.hub>
