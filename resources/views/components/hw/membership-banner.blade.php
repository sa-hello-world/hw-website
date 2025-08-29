<div class="p-4 bg-gradient-to-r from-neutral-950 to-neutral-900 border-l-4 border-cyan-400 rounded-md shadow-md shadow-cyan-500/20">
    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="size-6 text-cyan-500 drop-shadow-[0_0_6px_rgba(34,197,94,0.7)]">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>

        <p class="ml-2 text-gray-100">
            You are currently <span class="font-semibold">not a member</span>.
            <a href="{{route('welcome') . '#memberships'}}" class="text-cyan-400 font-semibold underline hover:text-cyan-600 transition">Become one today</a> and enjoy exclusive benefits!
        </p>
    </div>
</div>
