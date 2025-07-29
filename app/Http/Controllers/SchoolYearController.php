<?php

namespace App\Http\Controllers;

use App\Helpers\MoneyHelper;
use App\Models\SchoolYear;
use App\Rules\NoAcademicEndOverlap;
use App\Rules\NoAcademicStartOverlap;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Money\Currencies\ISOCurrencies;
use Money\Parser\DecimalMoneyParser;
use Money\Currency;

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
        $schoolYears = SchoolYear::orderBy('start_academic_year', 'desc')->get();

        return view('school-years.index', compact('currentSchoolYear', 'schoolYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        if (Auth::user()->cannot('create', SchoolYear::class)) {
            abort(403);
        }

        return view('school-years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        if (Auth::user()->cannot('create', SchoolYear::class)) {
            abort(403);
        }

        $rules = [
            'start_academic_year' => ['required', 'date', 'after_or_equal:today', new NoAcademicStartOverlap()],
            'end_academic_year' => ['required', 'date', 'after:start_academic_year', new NoAcademicEndOverlap()],
            'name_of_chairman' => ['nullable', 'string', 'max:255', 'min:3'],
            'regular_membership_price' => ['nullable', 'numeric', 'min:0'],
            'early_membership_price' => ['nullable', 'numeric', 'min:0'],
            'semester_membership_price' => ['nullable', 'numeric', 'min:0'],
        ];

        $validated = $request->validate($rules);

        $validated['regular_membership_price'] = MoneyHelper::parse($validated['regular_membership_price']);

        if ($validated['early_membership_price'] !== null) {
            $validated['early_membership_price'] = MoneyHelper::parse($validated['early_membership_price']);
        }
        if ($validated['semester_membership_price'] !== null) {
            $validated['semester_membership_price'] = MoneyHelper::parse($validated['semester_membership_price']);
        }

        SchoolYear::create($validated);

        return redirect()->route('school-years.index')
            ->with('success', 'School year created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear) : View
    {
        if (Auth::user()->cannot('update', $schoolYear)) {
            abort(403);
        }

        return view('school-years.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolYear $schoolYear) : RedirectResponse
    {
        if (Auth::user()->cannot('update', $schoolYear)) {
            abort(403);
        }

        $rules = [
            'start_academic_year' => ['required', 'date',  new NoAcademicStartOverlap($schoolYear->id)],
            'end_academic_year' =>
                ['required', 'date', 'after:start_academic_year', new NoAcademicEndOverlap($schoolYear->id)],
            'name_of_chairman' => ['nullable', 'string', 'max:255', 'min:3'],
            'regular_membership_price' => ['nullable', 'numeric', 'min:0'],
            'early_membership_price' => ['nullable', 'numeric', 'min:0'],
            'semester_membership_price' => ['nullable', 'numeric', 'min:0'],
        ];

        $validated = $request->validate($rules);

        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);

        $validated['regular_membership_price'] =
            $moneyParser->parse($validated['regular_membership_price'], new Currency('EUR'));

        if ($validated['early_membership_price'] !== null) {
            $validated['early_membership_price'] =
                $moneyParser->parse($validated['early_membership_price'], new Currency('EUR'));
        }
        if ($validated['semester_membership_price'] !== null) {
            $validated['semester_membership_price'] =
                $moneyParser->parse($validated['semester_membership_price'], new Currency('EUR'));
        }

        $schoolYear->update($validated);

        return redirect()->route('school-years.index')
            ->with('success', 'School year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear) : RedirectResponse
    {
        if (Auth::user()->cannot('delete', $schoolYear)) {
            abort(403);
        }

        $schoolYear->delete();

        return redirect()->route('school-years.index')
            ->with('success', 'School year deleted successfully.');
    }
}
