<x-layouts.app :title="'Home'">
    <div class="flex h-full w-full flex-col text-hw-dark bg-hw-dark">
        <x-layouts.home.greeting />
        <x-layouts.home.about-us />
        <x-layouts.home.event-list :events="$events" />
        <x-layouts.home.join-us :memberBenefits="$memberBenefits" :membershipPrices="$membershipPrices" />
        <x-layouts.home.sponsors-grid :sponsors="$sponsors" />
    </div>
</x-layouts.app>
