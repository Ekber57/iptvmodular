<?php 
namespace Modules\Otp\App\InternalApi;
use Modules\Otp\App\DTOS\OtpDTO;
use Modules\Interfaces\OtpInterface;
use Modules\Otp\App\Services\OtpService;

class OtpAPI implements OtpInterface{
    public function sendOTP(OtpDTO $otpDTO) {
        $otpService = new OtpService();
        $otpService->addOtp($otpDTO);
    }
    public function checkOTP($code) {
        $otpService = new OtpService();
        return $otpService->checkOtp($code);
    }

    public function deleteOTP($code) {
        $otpService = new OtpService();
        return $otpService->deleteOtp($code);
    }
}

?>