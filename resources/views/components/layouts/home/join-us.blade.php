<section class="bg-hw-dark md:p-20 p-6">
    <div class="mx-full text-center">
        <p class="text-white font-handwriting text-2xl mb-4">
            Caught your attention?
        </p>

        <h2 class="text-white text-5xl font-bayon mb-12 uppercase">
            SEE OUR MEMBER BENEFITS AND JOIN US
        </h2>

        <div class="bg-white rounded-2xl p-8 relative">
            <!-- Decorative chain in the middle -->
            <div class="absolute left-1/2 top-0 bottom-0 w-8 transform -translate-x-1/2 flex flex-col items-center justify-center space-y-8">
                @for($i = 0; $i < 9; $i++)
                    <div class="w-10 h-6 bg-hw-dark rounded-full"></div>
                @endfor
                <div class="absolute bg-hw-dark h-full w-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Non Member Side -->
                <section class="text-center px-8">
                    <div class="bg-hw-pink font-bayon px-6 py-2 text-3xl mb-6 inline-block rotate-[-6deg]">
                        NON MEMBER
                    </div>

                    <div class="space-y-4 text-left">
                        <div class="flex items-center space-x-3 text-md mb-4 leading-tight">
                            <span class="text-xl text-hw-green">✔</span>
                            <span>Small fee access to most events</span>
                        </div>
                    </div>

                    <!-- Membership cards illustration -->
                    <div class="absolute -bottom-24 -left-16 z-0">
                        <img src="{{ asset('/img/tickets.png') }}" alt="Tickets" class="w-[380px] object-contain rotate-[10deg]">
                    </div>
                </section>

                <!-- Member Side -->
                <section class="text-center px-8">
                    <div class="bg-hw-green font-bayon px-6 py-2 text-3xl mb-6 inline-block rotate-[6deg]">
                        MEMBER
                    </div>

                    <div class="space-y-4 text-left text-md mb-4 leading-tight">
                        <div class="flex items-center space-x-3">
                            <span class="text-xl text-hw-green">✔</span>
                            <span class="text-gray-800">Free access to most events</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-xl text-hw-green">✔</span>
                            <span class="text-gray-800">Discount fee on bigger events</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-xl text-hw-green">✔</span>
                            <span class="text-gray-800">Loyalty card access</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-xl text-hw-green">✔</span>
                            <span class="text-gray-800">Priority during registering for company visits</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-xl text-hw-green">✔</span>
                            <span class="text-gray-800">Free merch</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center px-2 mb-2">
                        <span class="text-xs text-white bg-hw-pink px-2 py-0.5 rounded font-bold">Order membership</span>
                    </div>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center justify-between p-3 rounded-lg">
                            <span class="text-lg text-hw-dark font-handwriting">Early bird - 15€</span>
                            <button class="bg-white border border-hw-dark text-hw-dark font-bold text-sm px-5 py-2 rounded-full">
                                Order
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg">
                            <span class="text-lg text-hw-dark font-handwriting">Normal - 30€</span>
                            <button class="bg-hw-green border border-hw-dark text-hw-dark font-bold text-sm px-5 py-2 rounded-full">
                                Order
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
