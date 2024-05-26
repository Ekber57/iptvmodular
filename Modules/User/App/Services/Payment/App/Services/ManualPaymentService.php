<?php
namespace Modules\Payment\App\Services;
use Modules\Payment\DTOS\ManualPaymentDTO;
use Modules\Payment\Models\PaymentCheck;
use Modules\Payment\Models\ManualPayment;

class ManualPaymentService 
{
    public function add(ManualPaymentDTO $manualPaymentDTO) {
        return ManualPayment::create([
            'user_id' =>  $manualPaymentDTO->userId,
            'amount' => $manualPaymentDTO->amount,
            'status' => 0
        ]);
    }

    public function addCheck($paymentId,$fileName) {
        return PaymentCheck::create([
            'payment_id' => $paymentId,
            'file_name' => $fileName
        ]);
    }
}
 




?>