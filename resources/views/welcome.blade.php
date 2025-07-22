<x-layouts.app :title="'Home'">
    <div class="flex h-full w-full flex-col gap-16 text-hw-dark bg-hw-dark dark:bg-hw-dark dark:text-white">
        <x-layouts.home.greeting />
        <x-layouts.home.about-us />
        <x-layouts.home.event-list :events="$events" />
        <x-layouts.home.join-us />
        <x-layouts.home.sponsors-grid :sponsors="$sponsors" />
    </div>
</x-layouts.app>
