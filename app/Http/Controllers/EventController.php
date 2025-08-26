<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index() : View
    {
        $nextEvent = Event::next();
        $nextEvents = Event::allNext(4);
        $pastEvents = Event::allPast(4);

        return view('events', compact('nextEvent', 'nextEvents', 'pastEvents'));
    }
}
