<div class="flex flex-col gap-6">
    <div class="text-center">
        <h1 class="text-2xl font-bayon text-white">Forgot password</h1>
        <p class="text-sm text-hw-blue-400 font-handwriting">Enter your email to receive a password reset link</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
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

        <button type="submit"
                class="w-full bg-hw-blue-600 hover:bg-hw-blue-800 hover:cursor-pointer text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200">
            Email password reset link
        </button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        <span>Or, return to</span>
        <a href="{{route('login')}}" wire:navigate class="underline text-hw-blue-300 mr-1">{{ __('log in') }}</a>
    </div>
</div>
