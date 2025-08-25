@php use App\Helpers\MoneyHelper;use Carbon\Carbon; @endphp

@props([
    'link' => null,
    'event',
])

<section class="p-6 h-full">
    <div class="mx-auto text-center h-full">
        <x-notebook-card extraClasses="flex h-full">
            <div class="grid grid-cols-1 md:grid-cols-2 h-full relative">
                <!-- Non Member Side -->
                <section class="rounded-l-3xl bg-cover bg-center"
                         style="background-image: url('{{asset('storage/' . $event->poster_path)}}'); background-size: cover;">
                </section>

                <!-- Member Side -->
                <section class="px-10 py-6 text-left space-y-2 text-gray-950">
                    <h1 class="text-3xl md:text-4xl font-bayon text-wrap uppercase tracking-wide">{{$event->name}}</h1>
                    <p>{{$event->description}}</p>
                    <div class="pt-2">
                        <h1 class="text-xl md:text-2xl font-bayon text-wrap uppercase tracking-wide">Details</h1>
                        <p>📅 Date: {{Carbon::parse($event->start)->format('jS F')}}</p>
                        <p>🕙 Time: {{Carbon::parse($event->start)->format('h:i')}}</p>
                        <p>📍 Location: {{$event->location}}</p>
                    </div>
                    <div class="pt-2">
                        <h1 class="text-xl md:text-2xl font-bayon text-wrap uppercase tracking-wide">Entrance fee</h1>
                        <p>💸 Regular fee: {{$event->regular_price ? '€ ' . MoneyHelper::toDecimal($event->regular_price) : 'Free!'}}</p>
                        <p>🤑 Member fee: {{$event->member_price ? '€ ' . MoneyHelper::toDecimal($event->member_price) : 'Free!'}}</p>
                    </div>
                    <section class="space-y-2 text-center">
                        @if($link)
                            @can('pay', $event)
                                <form method="POST" action="{{route($link, $event)}}">
                                    @csrf
                                    <x-hw.button variant="sign_up" type="submit">
                                        Sign up
                                    </x-hw.button>
                                </form>
                            @endcan
                            @guest
                                <x-hw.button variant="sign_up" type="submit">
                                    Login to sign up for the event
                                </x-hw.button>
                            @endguest
                        @else
                            <x-hw.button variant="sign_up">
                                Sign up
                            </x-hw.button>
                        @endif
                    </section>
                </section>
            </div>
        </x-notebook-card>
    </div>
</section>
