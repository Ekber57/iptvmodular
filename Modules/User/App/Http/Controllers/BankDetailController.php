<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\User\App\Actions\BankDetailsAction;

class BankDetailController extends Controller
{
    public function storeBankDetail(BankDetailsAction $bankDetailsAction) {
        return $bankDetailsAction->storeDetail();
    }

    
}
