<?php

namespace App\Http\Controllers;

use App\Enums\MembershipType;
use App\Helpers\MoneyHelper;
use App\Models\Event;
use App\Models\SchoolYear;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * passes the last 3 events, the sponsors, and some information about the join us section
     */
    public function index(): View
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

        $membershipPrices = [];

        if ($schoolYear) {
            $membershipPrices = [
                [
                    'label' => 'Early bird – ' . MoneyHelper::toDecimal($schoolYear->early_membership_price) . '€',
                    'highlight' => 'Few left',
                    'style' => 'bg-white',
                    'highlightColor' => 'bg-hw-pink',
                    'membershipType' => MembershipType::EARLY_BIRD,
                ],
                [
                    'label' => 'Normal – ' . MoneyHelper::toDecimal($schoolYear->regular_membership_price) . '€',
                    'highlight' => null,
                    'style' => 'bg-hw-green',
                    'highlightColor' => null,
                    'membershipType' => MembershipType::REGULAR,
                ],
                [
                    'label' => '1 semester – ' . MoneyHelper::toDecimal($schoolYear->semester_membership_price) . '€',
                    'highlight' => null,
                    'style' => 'bg-white',
                    'highlightColor' => null,
                    'membershipType' => MembershipType::SEMESTER,
                ],
            ];
        }

        return view('welcome', compact('events', 'sponsors', 'memberBenefits', 'membershipPrices'));
    }
}
