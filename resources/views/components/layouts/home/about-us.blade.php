<section class="md:p-20 p-6">
    <div class="mx-full bg-white rounded-2xl">
        <!-- Decorative dots border -->
        <div class="flex justify-center">
            <div class="flex md:space-x-8 space-x-2 my-3 overflow-hidden">
                @for($i = 0; $i < 27; $i++)
                    <div class="md:w-5 md:h-5 w-2 h-2 bg-hw-dark rounded-full"></div>
                @endfor
            </div>
        </div>

        <div class="text-hw-dark md:p-12 p-8">
            <h2 class="font-bayon text-5xl mb-6 uppercase">
                WHAT IS SA HELLO WORLD?
            </h2>

            <div>
                <h3 class="font-bold text-lg">Short answer</h3>
                <p class="text-md mb-4 leading-tight">
                    Study association "Hello World" is the study association for all students of the HBO-ICT
                    program at the HZ University of Applied Sciences located in Vlissingen and Middelburg.
                    Long answer? It’s so much more...
                </p>
            </div>

            <div>
                 <p class="text-md mb-4 leading-tight">
                     SA "Hello World" has officially existed since June 27, 2016, but we've been organizing
                     cool activities for HBO-ICT students since March 2015! We started the association to
                     create stronger connections between students from all years, host fun events, and help
                     make your study experience smoother. Whether it's through social gatherings, academic support,
                     or just being a point of contact when you need it, we're here to make student life
                     more enjoyable and connected!
                 </p>
            </div>

            <div class="flex md:flex-row flex-col items-center justify-between md:mt-12">
                <x-hw.button label="Read More" href="/aboutus" />
                <div class="relative">
                    <p class="text-hw-dark font-handwriting md:text-lg text-sm md:mt-0 mt-6 whitespace-nowrap relative z-10">
                        Okay, got it. So we are doing what now?
                    </p>

                    <!-- Blue lines -->
                    <div class="absolute left-0 bottom-0 w-full h-14">
                        <div class="absolute bottom-[2px] w-[80%] h-[3px] bg-hw-blue rounded-full"></div>
                        <div class="absolute left-[60%] -bottom-[4px] w-[40%] h-[3px] bg-hw-blue rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
