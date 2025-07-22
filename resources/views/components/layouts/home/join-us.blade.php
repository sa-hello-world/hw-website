<div class="bg-hwblack px-6 py-12">
    <div class="max-w-4xl mx-auto text-center">
        <p class="text-white font-handwritten text-2xl mb-4">
            Caught your attention?
        </p>

        <h2 class="text-white text-3xl font-title font-bold mb-12 uppercase">
            SEE OUR MEMBER BENEFITS AND JOIN US
        </h2>

        <div class="bg-white rounded-2xl p-8 relative">
            <!-- Decorative chain in the middle -->
            <div class="absolute left-1/2 top-0 bottom-0 w-8 transform -translate-x-1/2 flex flex-col items-center justify-center space-y-2">
                @for($i = 0; $i < 8; $i++)
                    <div class="w-6 h-6 border-4 border-gray-800 rounded-full bg-white"></div>
                @endfor
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Non Member Side -->
                <div class="text-center">
                    <div class="bg-hw-pink font-title text-white px-6 py-3 rounded-lg font-bold text-xl mb-6 inline-block">
                        NON MEMBER
                    </div>

                    <div class="space-y-4 text-left">
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 border-2 border-hw-green rounded flex items-center justify-center">
                                <div class="w-2 h-2 bg-hw-green rounded-full"></div>
                            </div>
                            <span class="text-gray-800">Small fee access to most events</span>
                        </div>
                    </div>

                    <!-- Membership cards illustration -->
                    <div class="mt-8 relative">
                        <div class="transform rotate-12 bg-pink-500 w-32 h-20 rounded-lg mx-auto relative">
                            <div class="absolute inset-2 bg-white rounded"></div>
                        </div>
                        <div class="transform -rotate-6 bg-green-400 w-32 h-20 rounded-lg mx-auto relative -mt-16">
                            <div class="absolute inset-2 bg-white rounded"></div>
                        </div>
                    </div>
                </div>

                <!-- Member Side -->
                <div class="text-center">
                    <div class="bg-hwgreen font-title text-white px-6 py-3 rounded-lg font-bold text-xl mb-6 inline-block">
                        MEMBER
                    </div>

                    <div class="space-y-4 text-left">
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 border-2 border-hw-green rounded flex items-center justify-center">
                                <div class="w-2 h-2 bg-hw-green rounded-full"></div>
                            </div>
                            <span class="text-gray-800">Free access to most events</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 border-2 border-green-500 rounded flex items-center justify-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            </div>
                            <span class="text-gray-800">Discount fee on bigger events</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 border-2 border-green-500 rounded flex items-center justify-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            </div>
                            <span class="text-gray-800">Loyalty card access</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 border-2 border-green-500 rounded flex items-center justify-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            </div>
                            <span class="text-gray-800">Priority during registering for company visits</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 border-2 border-green-500 rounded flex items-center justify-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            </div>
                            <span class="text-gray-800">Free merch</span>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center justify-between bg-gray-100 p-3 rounded-lg">
                            <span class="text-hw-dark font-handwriting">Early bird - 15€</span>
                            <button class="bg-white border-2 border-hw-dark px-4 py-1 rounded text-sm font-semibold">
                                Order
                            </button>
                        </div>
                        <div class="flex items-center justify-between bg-gray-100 p-3 rounded-lg">
                            <span class="text-hw-dark font-handwriting">Normal - 30€</span>
                            <button class="bg-white border-2 border-hw-dark px-4 py-1 rounded text-sm font-semibold">
                                Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
