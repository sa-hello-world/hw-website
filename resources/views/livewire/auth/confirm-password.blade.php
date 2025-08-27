<div class="flex flex-col gap-6">
    <div class="text-center">
        <h1 class="text-2xl font-bayon text-white">Confirm password</h1>
        <p class="text-sm text-hw-blue-400 font-handwriting">Please confirm your password before continuing.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        <!-- Password -->
        <div>
            <x-hw.label for="password" value="Password"/>
            <x-hw.input
                wire:model="password"
                type="password"
                required
                autocomplete="current-password"
            />
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="w-full bg-hw-blue-600 hover:bg-hw-blue-800 hover:cursor-pointer text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200">
            Confirm
        </button>
    </form>
</div>
