<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UploadInvoice extends Component
{
    public $invoice;
    public $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($invoice, $user)
    {
        $this->invoice = $invoice;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.upload-invoice');
    }
}
