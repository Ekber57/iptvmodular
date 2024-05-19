<?php 
namespace Modules\Otp\App\Services;

use Modules\Otp\App\DTOS\OtpDTO;
use Modules\Otp\Models\Otpcode;

class OtpService {
    public function addOtp(OtpDTO $otpDTO) {
         Otpcode::where("user_id","=",$otpDTO->userId)->delete();
        return Otpcode::create([
            'code' => $otpDTO->code,
            'user_id' => $otpDTO->userId,
            'status' => 0
        ]);
    }

    public function deleteOtp($code) {
        return Otpcode::where("code","=",$code)->first()->delete();
    }
    public function checkOtp($code) {
        $otp =  Otpcode::where("code","=",$code)->first();
        if(!is_null($otp)) {
            $otp->status = 1;
            $otp->save();
        }
        return $otp;
    }
}


?>