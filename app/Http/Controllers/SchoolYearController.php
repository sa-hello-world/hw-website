<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        if (Auth::user()->cannot('viewAny', SchoolYear::class)) {
            abort(403);
        }

        $currentSchoolYear = SchoolYear::current();
        $schoolYears = SchoolYear::all();

        return view('school-years.index', compact('currentSchoolYear', 'schoolYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('viewAny', SchoolYear::class)) {
            abort(403);
        }

        return view('school-years.create');
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
    public function show(SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear)
    {
        //
    }
}
