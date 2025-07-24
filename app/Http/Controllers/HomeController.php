<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(3)->get();
        $sponsors = Sponsor::all();

        return view('welcome', compact('events', 'sponsors'));
    }
}
