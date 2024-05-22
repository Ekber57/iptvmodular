<?php
namespace Modules\Auth\App\Actions;
use App\Models\User;
use Modules\Auth\App\Services\UserService;
use Modules\Interfaces\OtpInterface;
use Modules\Otp\App\DTOS\OtpDTO;

class PasswordAction {
    protected $userService;
    protected $authAction;
    protected $otpSevice;
    public function __construct(AuthAction $authAction,UserService $userService,OtpInterface $otpSevice) {
        $this->authAction = $authAction;
        $this->otpSevice = $otpSevice;
        $this->userService = $userService;
    }

    public function recoverPassword() {
        if(!$this->authAction->checkCaptchaStatus(request())) return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA doğrulaması başarısız. Lütfen tekrar deneyin.',]);
        $mailOrPhone = request()->username;
        $user = $this->userService->getUserByEmailOrPassword($mailOrPhone);
        if(is_null($user)) {
            return back()->withErrors([
                'data' => 'User is not exsist on system',
            ]);
        }
        else {
            $token = $this->userService->createResetToken($user);
            $otpDTO = new OtpDTO();
            $otpDTO->userId = $user->id;
            $otpDTO->code = mt_rand(100000, 999999);
            $otpDTO->number = $user->phone;
            $otpDTO->email = $user->email;

            $this->otpSevice->sendOTP($otpDTO);
            return redirect("/passreset?token=".$token);
        }
    }
    public function forgetPassword() {
        return view("auth::forgetpass");
    }

    public function passwordReset() {
        $token = request()->query("token");
        if(!is_null($this->userService->checkResetTokenIsset($token))) {

            return view("auth::passreset");
        }
        else {
            return redirect()->route("forgetPassword");
        }
        
    }
    public function storePassword() {
        
        $validatedData = request()->validate([
            'otp_code' => 'required|string|min:6|max:6',
            'password' => 'required|string|min:5|confirmed',
        ]);
        $otp = $this->otpSevice->checkOtp(request()->otp_code);
        if(!is_null($otp)) {
            $this->userService->resetPassword($otp->user_id,request()->password);
            $this->userService->clearAllResetTokens(User::find($otp->user_id));
            $this->otpSevice->deleteOTP(request()->otp_code);
            return redirect()->route('signin')->with('success', 'Password changed  successfully!');
        }
        else {
              return back()->withErrors([
                'data' => 'OTP code is not correct',
            ]);
        }

    }


}



?>