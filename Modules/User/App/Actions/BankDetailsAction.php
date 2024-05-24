<?php 
namespace Modules\User\App\Actions;
use Illuminate\Support\Facades\Auth;
use Modules\User\DTOS\BankDetailDTO;
use Modules\User\App\Services\BankDetailsService;

class BankDetailsAction {
    protected $bankDetailsService;

    public function __construct(BankDetailsService $bankDetailsService)
    {
        $this->bankDetailsService = $bankDetailsService;
    }

    public function storeDetail() {
        request()->validate([
            'bankname' => 'required|string|min:4|max:100',
            'cardnumber' => 'required|string|regex:/^[0-9]+$/',
            'customer' => 'required|string|min:8|max:200',
        ]);
        
        $bankDetailDTO = new BankDetailDTO();
        $bankDetailDTO->userId = Auth::user()->id;
        $bankDetailDTO->bankName = request()->bankname;
        $bankDetailDTO->cardNumber = request()->cardnumber;
        $bankDetailDTO->customer = request()->customer;
        
        $this->bankDetailsService->add($bankDetailDTO);
        return redirect()->back()->with('data', 'Bank melumatlari yenilendi.');
    }
    

}







?>