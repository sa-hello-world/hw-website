<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        $events = Event::orderBy('start', 'asc')->take(3)->get();

        return view('welcome', compact('sponsors', 'events'));
    }
}
