<?php

namespace App\Http\Controllers;

use App\Enums\MembershipType;
use App\Helpers\MoneyHelper;
use App\Mail\ContactUs;
use App\Models\Event;
use App\Models\SchoolYear;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PublicController extends Controller
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

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function events() : View
    {
        $nextEvent = Event::next();
        $nextEvents = Event::allNext(4);
        $pastEvents = Event::allPast(4);

        $route = 'payments.store.event';
        if (Auth::user()) {
            $price = $nextEvent->priceForUser(Auth::user());
            $route = is_null($price) || $price->getAmount() == 0 ? 'events.register' : $route;
        }

        return view('events', compact('nextEvent', 'nextEvents', 'pastEvents', 'route'));
    }

    /**
     * @return View
     * Get 6 random image filenames from /public/img/aboutUs
     * */
    public function aboutUs(): View
    {
        $imageFiles = collect(File::files(public_path('img/aboutUs')))
            ->filter(fn($file) => $file->getExtension() === 'jpg' || $file->getExtension() === 'png')
            ->shuffle()
            ->take(6)
            ->map(fn($file) => 'img/aboutUs/' . $file->getFilename());

        return view('aboutus', ['galleryImages' => $imageFiles]);
    }

    /**
     * Returns the public facing partners page
     * @return View
     */
    public function partners(): View
    {
        $sponsors = Sponsor::all();
        $tiers = $sponsors->groupBy('tier');

        $tierColors = [
            'gold' => 'border-yellow-400',
            'silver' => 'border-gray-300',
            'bronze' => 'border-orange-400',
        ];

        return view('partners', compact('sponsors', 'tiers', 'tierColors'));
    }

    /**
     * Shows the contact page
     * @return View
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Validates and send the message to the default HW email or
     * to the one in the env (if such exists)
     * @returns RedirectResponse
     */
    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' =>[
                'required',
                'email',
                'max:255',
                'min:3',
                Rule::email()
                    ->rfcCompliant()
                    ->validateMxRecord()
                    ->preventSpoofing()
            ],
            'subject' => 'required|string',
            'message' => 'required|string|min:8',
        ]);

        // makes the Email dynamic with the .env
        $recipientEmail = trim((string)config('app.email'));
        Mail::to($recipientEmail)->send(new ContactUs($data));

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon.');
    }
}
