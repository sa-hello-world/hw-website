<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index() : View {
        $user = Auth::user();
        $nextEvent = Event::next();
        $nextEvents = Event::allNext(5);
        $totalEventsAttended = $user->events->count();
        $currentSchoolYear = SchoolYear::current();
        $currentYearAttended =  $currentSchoolYear ? $user->events->where('school_year_id', $currentSchoolYear->id)->count() : null;

        $route = 'payments.store.event';
        if (Auth::user() && $nextEvent) {
            $price = $nextEvent->priceForUser(Auth::user());
            $route = is_null($price) || $price->getAmount() == 0 ? 'events.register' : $route;
        }

        return view('home.dashboard', compact('user', 'nextEvent', 'nextEvents', 'totalEventsAttended', 'currentYearAttended', 'route'));
    }
}
