<?php
namespace Modules\Iptv\App\Services;

use App\Models\User;
use Modules\Iptv\Models\Cashback;
use Modules\Iptv\DTOS\CashbackDTO;


class CashbackService {
    public function createPurse(User $user) {
        return Cashback::create([
            'user_id' => $user->id,
            'amount' => 0
        ]);
    }

    public function giveCashback(CashbackDTO $cashbackDTO) {
        $cashback = Cashback::where("user_id","=",$cashbackDTO->userId)->first();
        $cashback->amount = $cashback->amount + $cashbackDTO->amount;
        $cashback->save();
    }
}



?>