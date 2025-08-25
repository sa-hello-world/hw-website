<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use App\Models\SchoolYear;
use Illuminate\View\View;
use Livewire\Component;

class PreviewModal extends Component
{
    public Payment $payment;
    public SchoolYear|null $schoolYear;
    public bool $showModal = false;

    /**
     * Mounts the component
     * @param Payment $payment
     * @return void
     */
    public function mount(Payment $payment) : void
    {
        $this->payment = $payment;

        // @phpstan-ignore-next-line - meta data should always exist
        $this->schoolYear = $payment->meta->payable_type == 'membership' ? SchoolYear::findOrFail($payment->meta->payable_id) : null;
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
        return view('livewire.payments.preview-modal');
    }
}
