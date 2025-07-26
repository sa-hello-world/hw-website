@php use Carbon\Carbon; @endphp

<section class="p-6 h-full">
    <div class="mx-auto text-center h-full">
        <x-notebook-card extraClasses="flex h-full">
            <div class="grid grid-cols-1 md:grid-cols-2 h-full relative">
                <!-- Non Member Side -->
                <section class="rounded-l-3xl bg-cover bg-center"
                         style="background-image: url('{{asset('storage/' . $event->poster_path)}}');   background-size: cover;">
                </section>

                <!-- Member Side -->
                <section class="p-6 text-left space-y-2 text-gray-950">
                    <h1 class="text-3xl md:text-4xl font-bayon text-wrap uppercase tracking-wide">{{$event->name}}</h1>
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
        </x-notebook-card>
    </div>
</section>
