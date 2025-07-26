<x-layouts.hub>
    <h1 class="text-5xl font-bayon text-white pt-5">Add a new school year</h1>
    <form action="{{ route('school-years.store') }}" method="POST" enctype="multipart/form-data"
          class="max-w-5xl space-y-6 p-6 pl-0 rounded-lg shadow-md">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div>
                    <x-hw.label for="start_academic_year" value="Starting date of academic year" required/>
                    <x-hw.input type="date-local" name="start_academic_year" id="start_academic_year" value="{{ old('start_academic_year') }}" required/>
                    @error('start_academic_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-hw.label for="end_academic_year" value="Ending date of academic year" required/>
                    <x-hw.input type="date-local" name="end_academic_year" id="end_academic_year" value="{{ old('end_academic_year') }}" required/>
                    @error('end_academic_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-hw.label for="name_of_chairman" value="Name of Chairman" required/>
                    <x-hw.input type="text" name="name_of_chairman" id="name_of_chairman" value="{{ old('name_of_chairman') }}" required/>
                    @error('name_of_chairman') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>

            </div>
        </div>
    </form>
</x-layouts.hub>
