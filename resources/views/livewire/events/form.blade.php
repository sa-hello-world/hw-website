<div>
    @php use App\Enums\EventType;use App\Models\SchoolYear; @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-hw.label for="name" value="Event name" required/>
            <x-hw.input type="text" name="name" id="name" value="{{ old('name', $event->name ?? '') }}" required/>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="location" value="Location" required/>
            <x-hw.input type="text" name="location" id="location" value="{{ old('location', $event->location ?? '') }}" required/>
            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <x-hw.label for="description" value="Description" required/>
            <textarea name="description" id="description" rows="4"
                      class="w-full p-2 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs"
                      required>{{ old('description', $event->description ?? '') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="poster" value="Poster"/>
            <x-hw.file-upload name="poster"/>
            @if($event && $event->poster_path)
                <p class="mt-2 text-sm text-gray-400">Current poster:</p>
                <img src="{{ asset('storage/' . $event->poster_path) }}" alt="Poster" class="h-20 mt-1 rounded" />
            @endif
        </div>

        <div>
            <x-hw.label for="banner" value="Banner"/>
            <x-hw.file-upload name="banner"/>
            @if($event && $event->banner_path)
                <p class="mt-2 text-sm text-gray-400">Current banner:</p>
                <img src="{{ asset('storage/' . $event->banner_path) }}" alt="Banner" class="h-20 mt-1 rounded" />
            @endif
        </div>

        <div>
            <x-hw.label for="start" value="Start Date & Time" required/>
            <x-hw.input type="datetime-local" name="start" id="start" value="{{ old('start', $event->start ?? '') }}" required/>
            @error('start') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="end" value="End Date & Time"/>
            <x-hw.input type="datetime-local" name="end" id="end" value="{{ old('end', $event->end ?? '') }}"/>
            @error('end') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="regular_price" value="Regular Price"/>
            <x-hw.input type="number" name="regular_price" id="regular_price" step="0.01"
                        value="{{ old('regular_price', $event->regular_price ?? '') }}" required/>
            @error('regular_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="member_price" value="Membership Price"/>
            <x-hw.input type="number" name="member_price" id="member_price" step="0.01"
                        value="{{ old('member_price', $event->member_price ?? '') }}" required/>
            @error('member_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="type" value="Event Type" required/>
            <select name="type" id="type" required
                    class="w-full p-2 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs">
                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select type</option>
                @php
                    $selectedType = old('type') ?? $event->type ?? '';
                @endphp

                @foreach(EventType::cases() as $type)
                    <option value="{{ $type->value }}" {{ $selectedType === $type->value ? 'selected' : '' }}>
                        {{ ucfirst($type->value) }}
                    </option>
                @endforeach
            </select>
            @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="school_year_id" value="School Year" required/>
            <select name="school_year_id" id="school_year_id" required
                    class="w-full p-2 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs">
                @php
                    $selectedSchoolYearId = old('school_year_id') ?? $event->school_year_id ?? SchoolYear::available()->first()?->id;
                @endphp
                @foreach(SchoolYear::available() as $year)
                    <option value="{{ $year->id }}" {{ $selectedSchoolYearId == $year->id ? 'selected' : '' }}>
                        {{ $year->years }}
                    </option>
                @endforeach
            </select>
            @error('school_year_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="available_places" value="Available Places"/>
            <x-hw.input type="number" name="available_places" id="available_places"
                        value="{{ old('available_places', $event->available_places ?? '') }}" min="1"/>
            @error('available_places') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="open_for" value="Open For"/>
            <x-hw.input type="text" name="open_for" id="open_for" value="{{ old('open_for', $event->open_for ?? '') }}" required/>
            @error('open_for') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="flex flex-row-reverse gap-x-2 pt-4">
        <x-hw.button type="submit" variant="save">Create</x-hw.button>
        <x-hw.button type="button">
            <a href="{{ url()->previous() }}">Cancel</a>
        </x-hw.button>
    </div>
</div>
