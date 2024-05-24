<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\App\Actions\UserAction;

class UserController extends Controller
{
    public function storeUser(UserAction $userAction) {
        return $userAction->storeUser();
    }


}
