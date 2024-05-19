<?php
namespace Modules\Interfaces;

use Modules\Otp\App\DTOS\OtpDTO;

interface OtpInterface {
    function sendOTP(OtpDTO $otpDTO);
    function checkOTP(int $code);
    
}


?>