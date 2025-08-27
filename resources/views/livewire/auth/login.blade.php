<div class="flex flex-col gap-6">
    <div class="text-center">
        <h1 class="text-2xl font-bayon text-white">Log in to your account</h1>
        <p class="text-sm text-hw-blue-400 font-handwriting">Enter your email and password below to log in</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="login" class="flex flex-col gap-6">
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
            <x-hw.label for="password" value="Password"/>
            <x-hw.input
                wire:model="password"
                type="password"
                required
                autocomplete="current-password"
            />
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            @if (Route::has('password.request'))
                <a href="{{route('password.request')}}" wire:navigate
                   class="underline text-hw-blue-300 end-0 top-0 text-sm">{{ __('Forgot your password?') }}</a>
            @endif

        </div>

        <!-- Remember Me -->
        <label class="inline-flex items-center space-x-2">
            <input
                type="checkbox"
                class="rounded-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-xs focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
            >
            <span class="text-white">Remember me</span>
        </label>


        <div class="flex items-center justify-end">
            <button type="submit"
                    class="w-full bg-hw-blue-600 hover:bg-hw-blue-800 hover:cursor-pointer text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200">
                Log in
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <a href="{{route('register')}}" wire:navigate class="underline text-hw-blue-300">{{ __('Sign up') }}</a>
        </div>
    @endif
</div>
