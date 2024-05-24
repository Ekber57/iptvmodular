<?php 
namespace Modules\User\App\Services;
use Modules\User\DTOS\BankDetailDTO;
use Modules\User\Models\BankDetail;

class BankDetailsService {
    public function add(BankDetailDTO $bankDetailDTO) {
        BankDetail::where('user_id',$bankDetailDTO->userId)->delete();
        return BankDetail::create([
            'user_id' => $bankDetailDTO->userId,
            'bank_name' => $bankDetailDTO->bankName,
            'card_number' => $bankDetailDTO->cardNumber,
            'customer' => $bankDetailDTO->customer
        ]);
    }

    public function getDetail($userId) {
        return BankDetail::where("user_id",$userId)->first();
    }
}










?>