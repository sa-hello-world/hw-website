<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\View\View;
use Livewire\Component;

class SignUpModal extends Component
{
    public bool $showModal = false;
    public Event $event;

    /**
     * Toggles the component on and off
     * @param bool $show
     * @return void
     */
    public function show(bool $show): void
    {
        $this->showModal = $show;
    }

    /**
     * Renders the view
     * @return View
     */
    public function render() : View
    {
        return view('livewire.events.sign-up-modal');
    }
}
