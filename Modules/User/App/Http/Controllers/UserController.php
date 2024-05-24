<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\App\Actions\BankDetailsAction;

class UserController extends Controller
{
    public function storeBankDetail(BankDetailsAction $bankDetailsAction) {
        return $bankDetailsAction->storeDetail();
    }
}
