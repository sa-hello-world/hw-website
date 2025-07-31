<?php

namespace App\Http\Controllers;

use App\Enums\MembershipType;
use App\Helpers\MoneyHelper;
use App\Models\Payment;
use App\Models\SchoolYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Mollie\Laravel\Facades\Mollie;

// TODO: Add the event payment as well
class PaymentController extends Controller
{
    public function storeForMembership(MembershipType $membershipType) : RedirectResponse
    {
        // TODO: Fix gate!

        $currentSchoolYear = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'amount' => $currentSchoolYear->getPrice($membershipType->value),
            'description' => "Membership contribution for academic year {$currentSchoolYear->years}",
            'payable_type' => 'membership',
            'payable_id' => $currentSchoolYear->id,
            'membership_type' => $membershipType->value,
        ]);

        return redirect()->route('payments.review', $payment);
    }

    public function review(Payment $payment): View
    {
        return view('payments.review', compact('payment'));
    }

    /**
     * Cancels payment when it's still only within the application
     * @param Payment $payment
     * @return RedirectResponse
     */
    public function cancel(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return redirect('dashboard')->with('success', 'Payment has been cancelled.');
    }

    public function preparePayment(Payment $payment)
    {
        $payment = Mollie::api()
            ->payments
            ->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => MoneyHelper::toDecimal($payment->amount)
                ],
                'description' => $payment->description,
                'redirectUrl' => route('payments.review', $payment),
            ]);
    }

    public function success(): RedirectResponse
    {
        dd('Successs!!!');
    }

    public function webhook(): RedirectResponse
    {
        dd('31232');
    }
}
