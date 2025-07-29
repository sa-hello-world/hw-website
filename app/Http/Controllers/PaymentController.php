<?php

namespace App\Http\Controllers;

use App\Enums\MembershipType;
use App\Helpers\MoneyHelper;
use App\Models\Event;
use App\Models\Payment;
use App\Models\SchoolYear;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function createForMembership(Request $request) : RedirectResponse
    {
        // TODO: Fix gate!
        $validated = $request->validate([
            'membership_type' => ['required', new Enum(MembershipType::class)]
        ]);

        $currentSchoolYear = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'amount' => $currentSchoolYear->getPrice($validated['membership_type']),
            'description' => "Membership contribution for academic year {$currentSchoolYear->years}",
            'payable_type' => 'membership',
            'payable_id' => $currentSchoolYear->id,
            'membership_type' => $validated['membership_type'],
        ]);

        return redirect()->route('payments.review', $payment);
    }

    public function review(Payment $payment): View
    {
        return view('payments.review', compact('payment'));
    }
}
