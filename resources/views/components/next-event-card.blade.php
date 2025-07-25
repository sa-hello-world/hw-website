@php use Carbon\Carbon; @endphp

<section class="p-6 h-full">
    <div class="mx-auto text-center h-full">
        <div class="bg-gray-50 rounded-3xl relative overflow-visible shadow-xl z-10 h-full">
            <!-- Decorative chain in the middle -->
            <div
                class="bg-transparent absolute left-1/2 top-0 bottom-0 w-8 transform -translate-x-1/2 flex flex-col items-center justify-center space-y-6 md:space-y-4">
                @for($i = 0; $i < 12; $i++)
                    <div class="hidden md:block w-8 h-8 bg-hw-dark rounded-full"></div>
                @endfor
                <div class="hidden md:block absolute bg-hw-dark h-full w-2"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative h-full">
                <!-- Non Member Side -->
                <section class="text-center rounded-l-3xl"
                         style="background-image: url('{{asset('storage/' . $event->poster_path)}}');   background-size: cover;">
                </section>

                <!-- Member Side -->
                <section class="p-6 text-left space-y-2 text-gray-950">
                    <h1 class="text-3xl font-bayon text-wrap">{{$event->name}}</h1>
                    <p>{{$event->description}}</p>
                    <div>
                        <p>📅 Date: {{Carbon::parse($event->start)->format('jS F')}}</p>
                        <p>🕙 Time: {{Carbon::parse($event->start)->format('h:i')}}</p>
                        <p>📍 Location: {{$event->location}}</p>
                    </div>
                    <section class="space-y-2 text-center">
                        <x-hw.button variant="sign_up">
                            Sign up
                        </x-hw.button>
                    </section>
                </section>
            </div>
        </div>
    </div>
</section>
