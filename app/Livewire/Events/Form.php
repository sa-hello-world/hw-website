<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\View\View;
use Livewire\Component;

class Form extends Component
{
    public Event|null $event = null;

    /**
     * Renders the form
     * @return View
     */
    public function render() : View
    {
        return view('livewire.events.form');
    }
}
