<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny user');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function markAsBoardMember(User $user, User $model): bool
    {
        return $user->can('markAsBoardMember user') && !$model->was_board_member;
    }
}
