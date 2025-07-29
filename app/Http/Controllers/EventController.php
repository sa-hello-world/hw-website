<?php

namespace App\Http\Controllers;

use App\Enums\EventType;
use App\Helpers\MoneyHelper;
use App\Models\Event;
use App\Models\SchoolYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        if (Auth::user()->cannot('viewAny', Event::class)) {
            abort(403);
        }

        $currentSchoolYear = SchoolYear::current();

        $currentSchoolYearEventsCount = optional($currentSchoolYear)->events->count() ?? 0;
        $currentSchoolYearEvents = optional($currentSchoolYear)
            ->events()
            ->orderBy('start', 'desc')
            ->paginate(5, ['*'], 'current_page')
            ->withQueryString();

        $previousSchoolYear = SchoolYear::previous()->first();


        $previousSchoolYearEvents = new LengthAwarePaginator(collect([]), 0, 5, 1);
        if ($previousSchoolYear) {
            $previousSchoolYearEvents = $previousSchoolYear->events()
                ->orderBy('start', 'desc')
                ->paginate(5, ['*'], 'archive_page')
                ->withQueryString();
        }

        return view('events.index', compact(
            'currentSchoolYear',
            'currentSchoolYearEvents',
            'currentSchoolYearEventsCount',
            'previousSchoolYearEvents'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        if (Auth::user()->cannot('create', Event::class)) {
            abort(403);
        }

        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        if (Auth::user()->cannot('create', Event::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'poster' => 'nullable|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'banner' => 'nullable|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'available_places' => ['nullable', 'integer', 'min:1'],
            'start' => ['required', 'date', 'after_or_equal:today'],
            'end' => ['nullable', 'date', 'after:start'],
            'regular_price' => ['nullable', 'numeric', 'min:0'],
            'member_price' => ['nullable', 'numeric', 'min:0'],
            'type' => ['required', 'string', Rule::in(array_column(EventType::cases(), 'value'))],
            'open_for' => ['nullable', 'string', 'max:255'],
            'school_year_id' => ['required', 'integer', 'exists:school_years,id'],
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('event-posters', 'public');
        }
        if ($request->hasFile('banner')) {
            $validated['banner_path'] = $request->file('banner')->store('event-posters', 'public');
        }

        if ($validated['regular_price'] !== null) {
            $validated['regular_price'] = MoneyHelper::parse($validated['regular_price']);
        }
        if ($validated['member_price'] !== null) {
            $validated['member_price'] = MoneyHelper::parse($validated['member_price']);
        }

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event) : View
    {
        if (Auth::user()->cannot('update', $event)) {
            abort(403);
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event) : RedirectResponse
    {
        if (Auth::user()->cannot('update', $event)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'poster' => 'nullable|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'banner' => 'nullable|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'available_places' => ['nullable', 'integer', 'min:1'],
            'start' => ['required', 'date', 'after_or_equal:today'],
            'end' => ['nullable', 'date', 'after:start'],
            'regular_price' => ['nullable', 'numeric', 'min:0'],
            'member_price' => ['nullable', 'numeric', 'min:0'],
            'type' => ['required', 'string', Rule::in(array_column(EventType::cases(), 'value'))],
            'open_for' => ['nullable', 'string', 'max:255'],
            'school_year_id' => ['required', 'integer', 'exists:school_years,id'],
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('event-posters', 'public');
        }
        if ($request->hasFile('banner')) {
            $validated['banner_path'] = $request->file('banner')->store('event-posters', 'public');
        }

        if ($validated['regular_price'] !== null) {
            $validated['regular_price'] = MoneyHelper::parse($validated['regular_price']);
        }
        if ($validated['member_price'] !== null) {
            $validated['member_price'] = MoneyHelper::parse($validated['member_price']);
        }

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event) : RedirectResponse
    {
        if (Auth::user()->cannot('delete', $event)) {
            abort(403);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
