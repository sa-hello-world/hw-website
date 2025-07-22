<div class="bg-white px-6 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Decorative dots border -->
        <div class="flex justify-center mb-8">
            <div class="flex space-x-2">
                @for($i = 0; $i < 20; $i++)
                    <div class="w-3 h-3 bg-hw-dark rounded-full"></div>
                @endfor
            </div>
        </div>

        <div class="text-center">
            <h2 class="text-hw-dark font-title text-3xl font-bold mb-6 uppercase">
                WHAT IS SA HELLO WORLD?
            </h2>

            <div class="text-left max-w-2xl mx-auto space-y-4 text-hw-dark">
                <div>
                    <h3 class="font-bold text-lg">Short answer</h3>
                    <p class="text-sm">
                        Study association "Hello World" is the study association for all students of the HBO-ICT
                        program at the HZ University of Applied Sciences located in Vlissingen and Middelburg.
                    </p>
                </div>

                <div>
                    <p class="text-sm">
                        SA "Hello World" has officially existed since June 27, 2019, but we've been organizing
                        cool activities for HBO-ICT students since March 2018! We started the association to
                        bring all the HBO-ICT students together and to make your study experience smoother.
                        Whether it's through social gatherings, academic support, or just being a point of
                        contact when you need it, we're here to make sure the more enjoyable and connected!
                    </p>
                </div>
            </div>

            <x-hw.button/>

            <p class="mt-4 text-hw-blue font-handwritten text-lg">
                Okay, got it. So we are doing what now?
            </p>
        </div>
    </div>
</div>
