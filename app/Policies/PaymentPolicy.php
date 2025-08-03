<?php

namespace App\Policies;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    public function view(User $user, Payment $payment) : bool
    {
        return $user->id === $payment->user_id || $user->hasPermissionTo('view payments');
    }

    public function pay(User $user, Payment $payment) : bool
    {
        return $user->id === $payment->user_id && $payment->status == PaymentStatus::PENDING->value;
    }
}
