<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny event');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return $user->can('view event');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create event');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->can('update event') && $event->status == 'upcoming';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->can('delete event');
    }

    /**
     * Determines whether the user can register/pay for the event
     * @param User $user
     * @param Event $event
     * @return bool
     */
    public function pay(User $user, Event $event): bool
    {
        return !$user->events->contains($event);
    }
}
