<?php

namespace App\Http\Controllers;

use App\Enums\SponsorshipTier;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        if (Auth::user()->cannot('viewAny', Sponsor::class)) {
            abort(403);
        }

        $sponsorCounts = collect(SponsorshipTier::cases())
            ->mapWithKeys(fn ($tier) => [
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
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
