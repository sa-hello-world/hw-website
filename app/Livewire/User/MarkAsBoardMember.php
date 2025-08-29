<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use Livewire\Component;

class MarkAsBoardMember extends Component
{
    public bool $showModal = false;
    public User $user;

    /**
     * Toggles the component on and off
     * @param bool $show
     * @return void
     * @throws AuthorizationException
     */
    public function show(bool $show): void
    {
        $this->authorize('markAsBoardMember', $this->user);
        $this->showModal = $show;
    }

    /**
     * Marks the user as a board member
     * @return void
     * @throws AuthorizationException
     */
    public function markAsBoardMember(): void
    {
        $this->authorize('markAsBoardMember', $this->user);
        $this->user->update(['was_board_member' => true]);
        $this->redirect(route('board.users.index'));
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.user.mark-as-board-member');
    }
}
