<?php
namespace Modules\Payment\Events;
use Modules\Payment\Models\ManualPayment;

class ManualPaymentRequestEvent
{
    public $manualPayment;
    /**
     * Create a new event instance.
     */
    public function __construct(ManualPayment $manualPayment)
    {
        $this->manualPayment = $manualPayment;
    }
}
