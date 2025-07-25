<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class Form extends Component
{
    public Event|null $event = null;

    public function render()
    {
        return view('livewire.events.form');
    }
}
