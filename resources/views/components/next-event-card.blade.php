@php use App\Helpers\MoneyHelper;use Carbon\Carbon;use Illuminate\Support\Facades\Auth; @endphp

@props([
    'link' => null,
    'event',
    'isModal' => false,
])

<section class="p-6 h-full">
    <div class="mx-auto text-center h-full">
        <x-notebook-card extraClasses="flex h-full">
            <div class="grid grid-cols-1 md:grid-cols-2 h-full relative">
                <!-- Non Member Side -->
                @if($event->poster_path)
                    <section class="rounded-l-3xl bg-cover bg-center"
                             style="background-image: url('{{asset('storage/' . $event->poster_path)}}'); background-size: cover;">
                    </section>
                @else
                    <section
                        class="rounded-l-3xl bg-cover bg-center bg-hw-blue-500 transition-colors text-white text-center">
                        <div class="h-full flex justify-center items-center font-bayon text-3xl text-wrap">
                            {{$event->name}}
                        </div>
                    </section>
                @endif

                <!-- Member Side -->
                <section class="px-10 py-6 text-left space-y-2 text-gray-950 h-full">
                    <h1 class="text-2xl md:text-3xl font-bayon text-wrap uppercase tracking-wide">{{$event->name}}</h1>
                    <p>{{$event->description}}</p>
                    <div class="pt-2">
                        <h1 class="text-xl md:text-2xl font-bayon text-wrap uppercase tracking-wide">Details</h1>
                        <p>📅 Date: {{Carbon::parse($event->start)->format('jS F')}}</p>
                        <p>🕙 Time: {{Carbon::parse($event->start)->format('h:i')}}</p>
                        <p>📍 Location: {{$event->location}}</p>
                    </div>
                    <div class="pt-2">
                        @auth
                            @if(!Auth::user()->events->contains($event))
                                <h1 class="text-xl md:text-2xl font-bayon text-wrap uppercase tracking-wide">Entrance
                                    fee</h1>
                                <p class="{{Auth::user()->is_member ? 'line-through text-gray-500' : ''}}">💸 Regular
                                    fee: {{$event->regular_price ? '€ ' . MoneyHelper::toDecimal($event->regular_price) : 'Free!'}}</p>
                                <p class="{{!Auth::user()->is_member ? 'line-through text-gray-500' : ''}}">🤑 Member
                                    fee: {{$event->member_price ? '€ ' . MoneyHelper::toDecimal($event->member_price) : 'Free!'}}</p>
                            @elseif(Auth::user()->events->contains($event))
                                <div
                                    class="lg:flex items-center justify-center pointer-events-none w-full {{$isModal ? 'mt-6' : 'mt-12'}} hidden ">
                                    <div
                                        class="{{$isModal ? 'py-4 px-8 text-2xl' : 'py-8 px-10 text-5xl'}} border-5 border-hw-blue-500 -rotate-20 opacity-65">
                                        <span class="uppercase font-black text-hw-blue-500">SIGNED UP!</span>
                                    </div>
                                </div>
                            @endif
                        @endauth

                        @guest
                            <h1 class="text-xl md:text-2xl font-bayon text-wrap uppercase tracking-wide">Entrance
                                fee</h1>
                            <p>💸 Regular
                                fee: {{$event->regular_price ? '€ ' . MoneyHelper::toDecimal($event->regular_price) : 'Free!'}}</p>
                            <p>🤑 Member
                                fee: {{$event->member_price ? '€ ' . MoneyHelper::toDecimal($event->member_price) : 'Free!'}}</p>
                        @endguest
                    </div>
                    <section class="space-y-2 text-center mt-10">
                        @guest
                            <a href="{{route('login')}}">
                                <x-hw.button variant="sign_up" type="submit">
                                    Login to sign up for the event
                                </x-hw.button>
                            </a>
                        @endguest
                        @auth
                            @if($link)
                                @can('pay', $event)
                                    <form method="POST" action="{{route($link, $event)}}">
                                        @csrf
                                        <x-hw.button variant="sign_up" type="submit">
                                            Sign up
                                        </x-hw.button>
                                    </form>
                                @endcan
                            @else
                                <x-hw.button variant="sign_up">
                                    Sign up
                                </x-hw.button>
                            @endif

                        @endauth
                    </section>
                </section>
            </div>
        </x-notebook-card>
    </div>
</section>
