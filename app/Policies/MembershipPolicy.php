<?php

namespace App\Policies;

use App\Models\Membership;
use App\Models\User;

class MembershipPolicy
{
    /**
     * Determines whether the user can pay for membership
     * @param User $user
     * @return bool
     */
    public function pay(User $user) : bool
    {
        return !$user->is_member;
    }
}
