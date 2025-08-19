<?php

namespace App\Http\Controllers;

use App\Enums\MembershipType;
use App\Enums\PaymentStatus;
use App\Helpers\MoneyHelper;
use App\Models\Event;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mollie\Laravel\Facades\Mollie;
use Money\Money;
use function PHPUnit\Framework\isEmpty;

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
            'user_id' => Auth::user()->id,
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

    public function storeForEvent(Event $event) : RedirectResponse
    {
        $user = Auth::user();

        if ($user->cannot('pay', Event::class)) {
            abort(403);
        }

        $feeType = $user->is_member ? 'Membership' : 'Regular';
        $payment = Payment::create([
            'user_id' => $user->id,
            'amount' => $user->is_member ? ($event->member_price ?? Money::EUR(0)) : ($event->regular_price ?? Money::EUR(0)),
            'description' => "Entrance fee for the {$event->name} event ({$feeType} fee)",
        ]);
        $metaPaymentData = [];
        $metaPaymentData['payable_type'] = 'event';
        $metaPaymentData['payable_id'] = $event->id;
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

            $user = User::findOrFail($payment->user_id);
            if ($payment->meta['membership_type']) {
                $user->registerAsMemberForSchoolYear(SchoolYear::findOrFail($payment->meta['payable_id']), $payment);
            } else {
                $user->registerForEvent(Event::findOrFail($payment->meta['payable_id']));
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
