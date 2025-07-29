<?php

namespace App\Policies;

use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchoolYearPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny schoolYear');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SchoolYear $schoolYear): bool
    {
        return $user->can('view schoolYear');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create schoolYear');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SchoolYear $schoolYear): bool
    {
        return $user->can('update schoolYear') && !optional(SchoolYear::previous())->contains($schoolYear);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SchoolYear $schoolYear): bool
    {
        return $user->can('delete schoolYear');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SchoolYear $schoolYear): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SchoolYear $schoolYear): bool
    {
        return false;
    }
}
