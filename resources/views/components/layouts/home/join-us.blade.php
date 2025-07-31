@props(['memberBenefits', 'membershipPrices'])

<section class="bg-hw-dark md:p-20 p-6">
    <div class="mx-auto max-w-6xl text-center">
        <p class="text-gray-50 font-handwriting text-2xl mb-4">
            Caught your attention?
        </p>

        <h2 class="text-gray-50 text-4xl md:text-5xl font-bayon mb-12 uppercase leading-tight">
            SEE OUR MEMBER BENEFITS AND JOIN US
        </h2>

        <x-notebook-card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative pb-8">
                <!-- Non Member Side -->
                <section class="text-center px-4 md:px-8">
                    <div class="bg-hw-pink font-bayon px-6 py-2 text-3xl md:text-5xl mb-12 inline-block rotate-[-6deg]">
                        NON MEMBER
                    </div>

                    <div class="space-y-4 text-left">
                        <div class="flex items-center space-x-2 text-lg mb-4 leading-tight">
                            <span class="text-xl text-gray-400 font-handwriting font-bold leading-none">✔</span>
                            <span>Small fee access to most events</span>
                        </div>
                    </div>

                    <!-- Membership cards illustration -->
                    <div class="hidden md:block absolute z-30 -left-30">
                        <img src="{{ asset('/img/tickets.png') }}" alt="Tickets" class="w-[320px] lg:w-[460px] rotate-[10deg]">
                    </div>
                </section>

                <!-- Member Side -->
                <section class="text-center px-4 md:px-8">
                    <div class="bg-hw-green font-bayon px-6 py-2 text-3xl md:text-5xl mb-12 inline-block rotate-[6deg]">
                        MEMBER
                    </div>

                    <div class="space-y-3 text-left text-lg mb-12 leading-snug">
                        @foreach ($memberBenefits as $benefit)
                            <div class="flex items-center space-x-2">
                                <span class="text-xl text-gray-400 font-handwriting font-bold leading-none">✔</span>
                                <span class="text-gray-800">{{ $benefit }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Line and pink tag -->
                    <div class="relative my-4">
                        <div class="border-t-2 border-hw-dark"></div>
                        <span class="absolute -top-3 left-2 text-xs text-gray-50 bg-hw-pink px-2 py-0.5 rounded font-bold">
                            Order membership
                        </span>
                    </div>

                    <!-- Pricing options -->
                    <section class="space-y-2">
                        @foreach ($membershipPrices as $price)
                            <form action="{{route('payments.store.membership', $price['membershipType'])}}" method="POST">
                                @csrf
                                <div class="flex items-center justify-between rounded-lg relative">
                                    <span class="text-lg text-hw-dark font-handwriting">{{ $price['label'] }}</span>

                                    @if($price['highlight'])
                                        <div class="absolute -top-3 -right-3">
                                            <span class="text-xs text-gray-50 {{ $price['highlightColor'] }} px-2 py-0.5 rounded font-bold">
                                                {{ $price['highlight'] }}
                                            </span>
                                        </div>
                                    @endif

                                    <button type="submit" class="{{ $price['style'] }}
                                        border border-hw-dark text-hw-dark font-bold text-sm px-5 py-2 rounded-full hover:cursor-pointer">
                                        Order
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </section>
                </section>
            </div>
        </x-notebook-card>
    </div>
</section>
