<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\View\View;
use Livewire\Component;

class PreviewModal extends Component
{
    public bool $showModal = false;

    public Event $event;

    /**
     * Initializes the component
     * @param Event $event
     * @return void
     */
    public function mount(Event $event): void
    {
        $this->event = $event;
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
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.events.preview-modal');
    }
}
