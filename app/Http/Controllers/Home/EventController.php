<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Shows the listing of the resource
     * @return View
     */
    public function index() : View
    {
        $events = Auth::user()->events;

        return view('home.events.index', compact('events'));
    }

    /**
     * Shows the payment
     * @param Event $event
     * @return View
     */
    public function show(Event $event) : View
    {
        $user = Auth::user();
        abort_unless($user->events->contains($event), 404);

        $payment = $user->findPayment($event);

        return view('home.events.show', compact('event', 'payment'));
    }

    /**
     * Sparsely used route; used only as a shortcut if an event is a free one
     * (behind auth middleware)
     * @param Event $event
     * @return RedirectResponse
     */
    public function register(Event $event) : RedirectResponse
    {
        $user = Auth::user();
        abort_unless($user->can('pay', $event), 403);

        $user->registerForEvent($event);

        return redirect()->route('my.events.show', $event)
            ->with('success', 'Successfully registered for the ' . $event->name . ' event.');
    }
}
