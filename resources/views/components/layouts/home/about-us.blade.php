<section class="px-20">
    <div class="mx-full bg-white rounded-2xl">
        <!-- Decorative dots border -->
        <div class="flex justify-center">
            <div class="flex space-x-8 my-3">
                @for($i = 0; $i < 27; $i++)
                    <div class="w-5 h-5 bg-hw-dark rounded-full"></div>
                @endfor
            </div>
        </div>

        <div class="text-hw-dark p-12">
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

            <div class="flex items-center justify-between mt-12">
                <x-hw.button label="Read More" href="/aboutus" />
                <div class="relative">
                    <p class="text-hw-dark font-handwriting text-lg whitespace-nowrap relative z-10">
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
