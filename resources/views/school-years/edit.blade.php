@php use App\Helpers\MoneyFormatter; @endphp
<x-layouts.hub>
    <h1 class="text-5xl font-bayon text-white pt-5">Edit a school year</h1>
    <form action="{{ route('school-years.update', $schoolYear) }}" method="POST" enctype="multipart/form-data"
          class="max-w-5xl space-y-6 p-6 pl-0 rounded-lg shadow-md">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div>
                    <x-hw.label for="start_academic_year" value="Starting date of academic year" required/>
                    <x-hw.input type="date" name="start_academic_year" id="start_academic_year"
                                value="{{ old('start_academic_year', $schoolYear->start_academic_year ?? '') }}"
                                required/>
                    @error('start_academic_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-hw.label for="end_academic_year" value="Ending date of academic year" required/>
                    <x-hw.input type="date" name="end_academic_year" id="end_academic_year"
                                value="{{ old('end_academic_year', $schoolYear->end_academic_year ?? '') }}" required/>
                    @error('end_academic_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-hw.label for="name_of_chairman" value="Name of Chairman"/>
                    <x-hw.input type="text" name="name_of_chairman" id="name_of_chairman"
                                value="{{ old('name_of_chairman', $schoolYear->name_of_chairman ?? '') }}"/>
                    @error('name_of_chairman') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="space-y-6">
                <div>
                    <x-hw.label for="regular_membership_price" value="Regular membership price (EUR)" required/>
                    <x-hw.input
                        type="text"
                        name="regular_membership_price"
                        class="money-field"
                        id="regular_membership_price"
                        value="{{ old('regular_membership_price', MoneyFormatter::toDecimal($schoolYear->regular_membership_price) ?? '') }}"
                        step="0.01"
                        min="0"
                        inputmode="decimal"
                        required
                    />
                    @error('regular_membership_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-hw.label for="early_membership_price" value="Early membership price (EUR)"/>
                    <x-hw.input
                        type="text"
                        name="early_membership_price"
                        class="money-field"
                        id="early_membership_price"
                        value="{{ old('early_membership_price', MoneyFormatter::toDecimal( $schoolYear->early_membership_price) ?? '') }}"
                        step="0.01"
                        min="0"
                        inputmode="decimal"
                    />
                    @error('early_membership_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-hw.label for="semester_membership_price" value="Semester membership price (EUR)"/>
                    <x-hw.input
                        type="text"
                        name="semester_membership_price"
                        class="money-field"
                        id="semester_membership_price"
                        value="{{ old('semester_membership_price', MoneyFormatter::toDecimal($schoolYear->semester_membership_price) ?? '') }}"
                        step="0.01"
                        min="0"
                        inputmode="decimal"
                    />
                    @error('semester_membership_price') <p
                        class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
        <div class="flex flex-row-reverse gap-x-2 pt-4">
            <x-hw.button type="submit" variant="save">Create</x-hw.button>
            <x-hw.button type="button">
                <a href="{{ url()->previous() }}">Cancel</a>
            </x-hw.button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AutoNumeric.multiple('.money-field', {
                currencySymbol: '€',
                decimalPlaces: 2,
                decimalCharacter: '.',
                digitGroupSeparator: ',',
                minimumValue: '0',
                outputFormat: 'number',
                unformatOnSubmit: true,
                modifyValueOnWheel: false,
                showOnlyNumbersOnFocus: false,
            });
        });

    </script>
</x-layouts.hub>
