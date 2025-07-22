<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class GuestNavigationMenu extends Component
{

    /**
     * Renders the guest navigation
     * @return View
     */
    public function render() : View
    {
        return view('livewire.guest-navigation-menu');
    }
}
