<?php

namespace App\Policies;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    /**
     * Determines whether the user can view the payment
     * @param User $user
     * @param Payment $payment
     * @return bool
     */
    public function view(User $user, Payment $payment) : bool
    {
        return $user->id === $payment->user_id || $user->hasPermissionTo('view payment');
    }

    /**
     * Determines whether the user can pay
     * @param User $user
     * @param Payment $payment
     * @return bool
     */
    public function pay(User $user, Payment $payment) : bool
    {
        return $user->id === $payment->user_id && $payment->status == PaymentStatus::PENDING->value;
    }
}
