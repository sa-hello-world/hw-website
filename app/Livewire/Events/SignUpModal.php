<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class SignUpModal extends Component
{
    public bool $showModal = false;
    public Event $event;
    public string $route = 'payments.store.event';

    /**
     * Mounts the component
     * @param Event $event
     * @return void
     */
    public function mount(Event $event) : void
    {
        $this->event = $event;
        if (Auth::user()) {
            $price = $event->priceForUser(Auth::user());
            $this->route = is_null($price) || $price->getAmount() == 0 ? 'events.register' : $this->route;
        }
    }

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
