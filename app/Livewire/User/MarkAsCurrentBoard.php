<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class MarkAsCurrentBoard extends Component
{
    public bool $showModal = false;
    public User $user;
    public bool $markAsBoardMember = true;
    public string $authRule = 'markAsCurrentBoardMember';
    public string $board_role = '';

    /**
     * @var array<string>
     */
    public array $boardRoles;

    /**
     * Initializes the component
     * @return void
     */
    public function mount() : void {
        $this->boardRoles = config('roles');
        $this->board_role = $this->boardRoles[0];
    }

    /**
     * Toggles the component on and off
     * @param bool $show
     * @return void
     * @throws AuthorizationException
     */
    public function show(bool $show): void
    {
        $this->authRule = $this->markAsBoardMember ? $this->authRule : 'removeAsCurrentBoardMember';
        $this->authorize($this->authRule, $this->user);
        $this->showModal = $show;
    }

    /**
     * Marks the user as a board member
     * @return void
     * @throws AuthorizationException
     */
    public function save(): void
    {
        $this->authorize($this->authRule, $this->user);

        if ($this->markAsBoardMember) {
            $this->user->assignRole($this->board_role);
        } else {
            foreach ($this->boardRoles as $boardRole) {
                $this->user->removeRole($boardRole);
            }
        }

        $this->redirect(route('board.users.index'));
    }

    public function render()
    {
        return view('livewire.user.mark-as-current-board');
    }
}
