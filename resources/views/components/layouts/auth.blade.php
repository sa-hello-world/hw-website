<x-layouts.app :title="$title ?? null">
    <div class="min-h-screen antialiased bg-linear-to-b from-neutral-950 to-neutral-900">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <a href="{{ route('welcome') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex w-36 mb-1 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-white" />
                    </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
    </div>
</x-layouts.app>
