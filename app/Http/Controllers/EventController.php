<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentSchoolYear = SchoolYear::current();

        $currentSchoolYearEventsCount = optional($currentSchoolYear)->events->count() ?? 0;
        $currentSchoolYearEvents = optional($currentSchoolYear)
            ->events()
            ->orderBy('start', 'desc')
            ->paginate(10);

        return view('events.index', compact('currentSchoolYear', 'currentSchoolYearEvents', 'currentSchoolYearEventsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
