<?php

namespace App\Http\Controllers;

use App\Enums\SponsorshipTier;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (Auth::user()->cannot('viewAny', Sponsor::class)) {
            abort(403);
        }

        $sponsorCounts = collect(SponsorshipTier::cases())
            ->mapWithKeys(fn($tier) => [
                $tier->value => Sponsor::whereTier($tier->value)->count(),
            ])
            ->toArray();

        $sponsors = Sponsor::all();

        return view('sponsors.index', compact('sponsorCounts', 'sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', Sponsor::class)) {
            abort(403);
        }

        return view('sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Sponsor::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'tier' => ['required', Rule::in(array_map(fn($e) => $e->value, SponsorshipTier::cases()))],
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'website' => ['required', 'regex:/^www\.[\w\-]+\.[\w\-\.]+$/i'],
        ]);

        $logo = $request->file('logo');
        $path = $logo->store('uploads', 'public');

        Sponsor::create(array_merge($validated, ['logo_path' => $path]));

        return redirect()->route('sponsors.index')
            ->with('success', 'Sponsor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        return view('sponsors.edit', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        if (Auth::user()->cannot('update', $sponsor)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'tier' => ['required', Rule::in(array_map(fn($e) => $e->value, SponsorshipTier::cases()))],
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'website' => ['required', 'regex:/^www\.[\w\-]+\.[\w\-\.]+$/i'],
        ]);

        if ($logo = $request->file('logo')) {
            $path = $logo->store('uploads', 'public');
            $validated['logo_path'] = $path;
        }

        $sponsor->update($validated);

        return redirect()->route('sponsors.index')
            ->with('success', 'Sponsor updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
