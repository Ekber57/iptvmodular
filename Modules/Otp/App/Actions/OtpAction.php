<?php
namespace Modules\Otp\App\Actions;
use Modules\Otp\App\DTOS\OtpDTO;
use Modules\Otp\App\Services\OtpService;

class OtpAction{
    protected $otpService;
    public function __construct(OtpService $otpService){
        $this->otpService = $otpService;
    }
    public function createOTP() {
        $otpDTO = new OtpDTO();
        $otpDTO->code = 2578;
        $otpDTO->userId = 2;
        $this->otpService->addOtp($otpDTO);
    }
}




?>