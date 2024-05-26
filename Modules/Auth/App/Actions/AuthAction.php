<?php
namespace Modules\Auth\App\Actions;

use GuzzleHttp\Client;
use App\Events\UserRegisterEvent;
use Modules\Auth\App\DTOS\UserDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Modules\Auth\App\Services\UserService;
use Modules\Auth\App\Http\Requests\SignInRequest;
use Modules\Auth\App\Http\Requests\RegisterRequest;

class AuthAction
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function addUser(RegisterRequest $request)
    {
        if(!$this->checkCaptchaStatus($request)) return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA doğrulaması başarısız. Lütfen tekrar deneyin.',]);
        $userDTO = new UserDTO();
        $userDTO->name = $request->name;
        $userDTO->email = $request->mail;
        $userDTO->phone = $request->phone;
        $userDTO->username = $request->username;
        $userDTO->password = $request->password;
        $userDTO->balance = 0;
        $user = $this->userService->addUser($userDTO);
        event(new UserRegisterEvent($user));
        if (!Auth::check()) {
            Auth::login($user);
        }
        return redirect("/dashboard");
    }

    public function signIn(SignInRequest $request)
    {
        if(!$this->checkCaptchaStatus($request)) return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA doğrulaması başarısız. Lütfen tekrar deneyin.',]);
        $userDTO = new UserDTO();
        $userDTO->password = $request->password;
        $userDTO->username = $request->username;
      
        $user = $this->userService->getUserWithCridential($userDTO);

        if (!is_null($user)) {
            if ($this->checkPassword(request()->password,$user)) {
                Auth::login($user);
                return redirect("/dashboard");
            } else {

                return back()->withErrors([
                    'password' => 'The provided credentials do not match our records.',
                ]);
            }
        } else {
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
        }

    }

    public function checkCaptchaStatus($request)
    {

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('GOOGLE_RECAPTCHA_PRIVATE_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        ]);

        $body = json_decode((string) $response->getBody());
     
        if (!$body->success) {
            return false;
        }
        else {
            return true;
        }
    }

    private function checkPassword($password,$user) {
        
        if($password === Crypt::decrypt($user->password)) {
            return true;
        }
        else {
            return false;
        }
    }
}
