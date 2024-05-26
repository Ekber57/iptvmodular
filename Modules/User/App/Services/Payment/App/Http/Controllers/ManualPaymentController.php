<?php

namespace Modules\Payment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Payment\App\Actions\ManualPaymentAction;

class ManualPaymentController extends Controller
{
    public function makePayment(ManualPaymentAction $manualPaymentAction) {
       return  $manualPaymentAction->add();
    }
}
