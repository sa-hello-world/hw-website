<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $showModal = false;

    public $model;
    public string $route;

    public function mount($model, string $route): void
    {
        $this->model = $model;
        $this->route = $route;
    }

    public function show(): void
    {
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }
}
