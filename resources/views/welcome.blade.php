<x-layouts.app :title="'Home'">
    <div class="flex h-full w-full flex-col gap-16 p-8 text-hw-dark bg-white dark:bg-hw-dark dark:text-white">
        <x-layouts.home.greeting />
        <x-layouts.home.about-us />
        <x-layouts.home.event-list :events="$events" />
        <x-layouts.home.sponsors-grid :sponsors="$sponsors" />
        <x-layouts.home.join-us />
    </div>
</x-layouts.app>
