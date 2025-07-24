<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SchoolYear;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(3)->get();
        $sponsors = Sponsor::all();

        $memberBenefits = [
            'Free access to most events',
            'Discount fee on bigger events',
            'Loyalty card access',
            'Priority during registering for company visits',
            'Free merch',
        ];

        $schoolYear = SchoolYear::latest('start_academic_year')->first();

        $membershipPrices = [
            [
                'label' => 'Early bird – ' . $schoolYear->early_membership_price . '€',
                'highlight' => 'Few left',
                'style' => 'bg-white',
                'highlightColor' => 'bg-hw-pink',
            ],
            [
                'label' => 'Normal – ' . $schoolYear->regular_membership_price . '€',
                'highlight' => null,
                'style' => 'bg-hw-green',
                'highlightColor' => null,
            ],
            [
                'label' => '1 semester – ' . $schoolYear->semester_membership_price . '€',
                'highlight' => null,
                'style' => 'bg-white',
                'highlightColor' => null,
            ],
        ];

        return view('welcome', compact('events', 'sponsors', 'memberBenefits', 'membershipPrices'));
    }
}
