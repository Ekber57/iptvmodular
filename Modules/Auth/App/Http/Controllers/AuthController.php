<?php

namespace Modules\Auth\App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Actions\AuthAction;
use Modules\Auth\App\Actions\PasswordAction;
use Modules\Auth\App\Http\Requests\SignInRequest;
use Modules\Auth\App\Http\Requests\RegisterRequest;

class AuthController
{
    public function register(RegisterRequest $request, AuthAction $authAction)
    {
       return $authAction->addUser($request);
      
    }
    public function login(SignInRequest $request, AuthAction $authAction)
    {
        
        return $authAction->signIn($request);;
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/signin'); // Redirect to the home page or any other desired location
    }

    public function forgetPassword(PasswordAction $passwordAction) {
        return $passwordAction->forgetPassword();
    }
    public function recoverPassword(PasswordAction $passwordAction) {
        return $passwordAction->recoverPassword();
    }

    public function passwordReset(PasswordAction $passwordAction) {
        return $passwordAction->passwordReset();
    }

    public function storePassword(PasswordAction $passwordAction) {
        return $passwordAction->storePassword();
    }
}
