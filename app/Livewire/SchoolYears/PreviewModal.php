<?php

namespace App\Livewire\SchoolYears;

use App\Models\SchoolYear;
use Illuminate\View\View;
use Livewire\Component;

class PreviewModal extends Component
{
    public bool $showModal = false;
    public SchoolYear $schoolYear;

    /**
     * Initializes the component
     * @param SchoolYear $schoolYear
     * @return void
     */
    public function mount(SchoolYear $schoolYear): void
    {
        $this->schoolYear = $schoolYear;
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
        return view('livewire.school-years.preview-modal');
    }
}
