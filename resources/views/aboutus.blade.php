<x-layouts.app :title="'About Us'">
    <section class="flex h-full w-full flex-col text-hw-dark bg-hw-dark md:px-20 px-6">
        <h2 class="text-gray-50 font-bayon text-5xl my-6">About us</h2>

        <!-- Association Info -->
        <div class="text-gray-50 text-lg space-y-6">
            <p>
                Study association <strong>“Hello World”</strong> is the study association for all students of the HBO-ICT program of the HZ University of Applied Sciences. Long answer? It’s so much more...
            </p>
            <p>
                SA "Hello World" has officially existed since <strong>June 27, 2016</strong>, but we've been organizing cool activities for HBO-ICT students since <strong>March 2015</strong>! We started the association to create stronger connections between students from all years, host fun events, and help make your study experience smoother.
            </p>
            <p>
                Whether you're just starting out or already deep in your studies, we’re here to make your time unforgettable. We organize exciting
                <strong>company visits</strong> that give you a chance to network with industry professionals, host chill
                <strong>pizza & drinks nights</strong> where you can meet fellow students, teachers, and higher-year legends,
                and even run fun social tournaments like <strong>beer pong</strong> and <strong>table tennis</strong>.
                On top of that, we frequently <strong>collaborate with other associations</strong> to throw even bigger
                parties and activities. From academic boosts to social adventures - we’ve got something for everyone.
            </p>
        </div>

        <!-- Static Gallery -->
        <div class="mt-12">
            <h3 class="text-gray-50 font-bayon text-3xl mb-6">Moments We Cherish 📸</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($galleryImages as $image)
                    <img src="{{ asset($image) }}" alt="Gallery Image" class="rounded-xl object-cover w-full h-64">
                @endforeach
            </div>
        </div>

        <!-- More Info -->
        <!-- Enhanced Why Join Us Section -->
        <section class="bg-hw-dark md:py-20 py-6">
            <h3 class="text-gray-50 font-bayon text-3xl mb-6">Why join us?</h3>
            <div class="text-center">
                <div class="bg-gray-50 rounded-3xl p-6 md:p-12 relative overflow-visible shadow-xl z-10">
                    <!-- Decorative chain in the middle -->
                    <div class="absolute left-1/2 top-0 bottom-0 w-8 transform -translate-x-1/2 flex flex-col items-center justify-center space-y-6 md:space-y-8">
                        @for($i = 0; $i < 7; $i++)
                            <div class="hidden md:block w-8 h-8 bg-hw-dark rounded-full"></div>
                        @endfor
                        <div class="hidden md:block absolute bg-hw-dark h-full w-2"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative">

                        <!-- Non Member Side -->
                        <section class="text-center px-4 md:px-8">
                            <div class="bg-hw-pink font-bayon px-6 py-2 text-2xl md:text-3xl mb-12 inline-block rotate-[-6deg]">
                                Join our events
                            </div>

                            <div class="space-y-4 text-left">
                                <ul class="list-disc ml-5 space-y-2 text-lg">
                                    <li>Get free or discounted access to our events</li>
                                    <li>Participate in scavenger hunts, workshops & LAN parties</li>
                                    <li>Use our loyalty card and win prizes</li>
                                    <li>Receive exclusive Hello World merch</li>
                                </ul>
                            </div>
                        </section>

                        <!-- Member Side -->
                        <section class="text-center px-4 md:px-8">
                            <div class="bg-hw-green font-bayon px-6 py-2 text-2xl md:text-3xl mb-12 inline-block rotate-[6deg]">
                                Join our team
                            </div>

                            <div class="space-y-4 text-left">
                                <ul class="list-disc ml-5 space-y-2 text-lg">
                                    <li>Join a team of passionate ICT students</li>
                                    <li>Plan events, manage social media, or design promo content</li>
                                    <li>Get leadership experience & build your resume</li>
                                    <li>Make new friends and grow your skills!</li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </section>
</x-layouts.app>
