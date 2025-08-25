<a href="">
    @if($event->poster_path)
        <img src="{{asset('storage/' . $event->poster_path)}}" class="h-81 rounded-xl w-full" alt="Event poster"/>
    @else
        <div class="h-81 w-full bg-hw-blue-500 hover:bg-hw-blue-600 transition-colors text-white rounded-xl text-center">
            <div class="h-full flex justify-center items-center font-bayon text-3xl text-wrap">
                {{$event->name}}
            </div>
        </div>
    @endif
</a>
