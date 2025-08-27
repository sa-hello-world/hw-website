@php use App\Enums\StudyYear; @endphp
<div class="flex flex-col gap-6">
    <div class="text-center">
        <h1 class="text-2xl font-bayon text-white">Create an account</h1>
        <p class="text-sm text-hw-blue-400 font-handwriting">Enter your details below to create your account</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="register" class="flex flex-col gap-6">
        <div>
            <x-hw.label for="name" value="Name"/>
            <x-hw.input
                wire:model="name"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="Full name"
            />
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="email" value="Email"/>
            <x-hw.input
                wire:model="email"
                type="email"
                required
                autocomplete="email"
                placeholder="mail0000@hz.nl"
            />
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="year" value="Study Year"/>
            <select name="year" id="year" required wire:input="study_year"
                    class="w-full p-2 border-hw-blue border bg-hw-dark text-gray-200 focus:border-hw-blue-600 focus:ring-hw-blue-600 rounded shadow-xs">
                @foreach(StudyYear::cases() as $year)
                    <option
                        value="{{ $year->value }}">
                        {{ ucfirst($year->value) }}
                    </option>
                @endforeach
            </select>
            @error('study_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="password" value="Password"/>
            <x-hw.input
                wire:model="password"
                type="password"
                required
                autocomplete="new-password"
            />
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-hw.label for="password" value="New Password"/>
            <x-hw.input
                wire:model="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
            />
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                    class="w-full bg-hw-blue-600 hover:bg-hw-blue-800 hover:cursor-pointer text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200">
                Create account
            </button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        <span>{{ __('Already have an account?') }}</span>
        <a href="{{route('login')}}" wire:navigate class="underline text-hw-blue-300">{{ __('Log in') }}</a>
    </div>
</div>
