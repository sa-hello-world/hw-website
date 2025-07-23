<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $showModal = false;

    public $model;
    public string $route;

    /**
     * Initializes the component
     * @param $model
     * @param string $route
     * @return void
     */
    public function mount($model, string $route): void
    {
        $this->model = $model;
        $this->route = $route;
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
        return view('livewire.delete-modal');
    }
}
