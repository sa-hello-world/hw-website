<?php

namespace App\Http\Controllers;

use App\Enums\MembershipType;
use App\Enums\PaymentStatus;
use App\Helpers\MoneyHelper;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\SchoolYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mollie\Laravel\Facades\Mollie;

// TODO: Add the event payment as well
class PaymentController extends Controller
{
    public function storeForMembership(MembershipType $membershipType) : RedirectResponse
    {
        if (Auth::user()->cannot('pay', Membership::class)) {
            abort(403);
        }

        $currentSchoolYear = SchoolYear::current();

        $description = "Membership contribution for academic year {$currentSchoolYear->years}";
        $payment = Payment::create( [
            'user_id' => auth()->id(),
            'amount' => $currentSchoolYear->getPrice($membershipType->value),
            'description' => $description,
        ]);

        $metaPaymentData = [];
        $metaPaymentData['payable_type'] = 'membership';
        $metaPaymentData['payable_id'] = $currentSchoolYear->id;
        $metaPaymentData['membership_type'] = $membershipType->value;

        if ($membershipType == MembershipType::SEMESTER) {
            $payment->description .= " (Semester {$currentSchoolYear->semester_number})";
            $metaPaymentData['semester'] = $currentSchoolYear->semester_number;
        }

        $payment->meta = $metaPaymentData;
        $payment->save();

        return redirect()->route('payments.show', $payment);
    }

    public function show(Payment $payment): View
    {
        if (Auth::user()->cannot('view', $payment)) {
            abort(403);
        }

        $schoolYear = SchoolYear::find($payment->meta['payable_id']);

        return view('payments.show', compact('payment', 'schoolYear'));
    }

    /**
     * Cancels payment when it's still only within the application
     * @param Payment $payment
     * @return RedirectResponse
     */
    public function cancel(Payment $payment): RedirectResponse
    {
        if (Auth::user()->cannot('pay', $payment)) {
            abort(403);
        }

        $payment->delete();

        return redirect('dashboard')->with('success', 'Payment has been cancelled.');
    }

    public function prepare(Payment $payment): RedirectResponse
    {
        if (Auth::user()->cannot('pay', $payment)) {
            abort(403);
        }

        $molliePayment = Mollie::api()
            ->payments
            ->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => MoneyHelper::toDecimal($payment->amount)
                ],
                'description' => $payment->description,
                'redirectUrl' => route('payments.callback', $payment),
                #'webhookUrl' => route('payments.webhook'),
            ]);

        $payment->update(['mollie_id' => $molliePayment->id]);

        return redirect($molliePayment->getCheckoutUrl(), 303);
    }

    public function callback(Payment $payment): RedirectResponse
    {
        if (Auth::user()->cannot('view', $payment)) {
            abort(403);
        }

        $molliePayment = Mollie::api()->payments->get($payment->mollie_id);

        if($molliePayment->isPaid())
        {
            $payment->update([
                'status' => PaymentStatus::PAID->value,
                'paid_at' => $molliePayment->paidAt,
            ]);

            $membership = Membership::create([
                'user_id' => Auth::user()->id,
                'school_year_id' => $payment->meta['payable_id'],
                'payment_id' => $payment->id,
            ]);

            if($payment->meta['membership_type'] == MembershipType::SEMESTER->value) {
                $membership->update(['semester' => $payment->meta['semester']]);
            }

            return redirect()->route('payments.show', $payment)
                ->with('success', 'Payment has been confirmed.');
        }

        return redirect()->route('payments.show', $payment)
            ->with('error', 'Something has gone wrong or it could be just your payment being processed slower. If this continue contact us.');
    }

    public function webhook(): RedirectResponse
    {
        //TODO: issue #30
    }
}
