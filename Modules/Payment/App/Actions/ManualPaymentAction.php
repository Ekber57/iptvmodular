<?php
namespace Modules\Payment\App\Actions;

use App\Events\ManualPaymentRequestEvent;
use Exception;
use Modules\Payment\App\Services\ManualPaymentService;
use Modules\Payment\DTOS\ManualPaymentDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManualPaymentAction {
    protected $manualPaymentService;

    public function __construct(ManualPaymentService $manualPaymentService)
    {
        $this->manualPaymentService = $manualPaymentService;
    }

    public function add() {
        request()->validate([
            'amount' => 'required|numeric|min:1|max:1000', 
            'file' => 'required|file|mimes:gif,png,jpeg,jpg|max:3000',// Ensure the file is a JSON file
        ]);
        try {
            $fileName = $this->uploadCheckFile();
            DB::beginTransaction();
            $manualPaymentDTO = new ManualPaymentDTO();
            $manualPaymentDTO->amount = request()->amount;
            $manualPaymentDTO->userId = Auth::user()->id;
            $payment = $this->manualPaymentService->add($manualPaymentDTO);
            $this->manualPaymentService->addCheck($payment->id,$fileName);
            DB::commit();
            event(new ManualPaymentRequestEvent($payment));
            return redirect()->route('manual_payment')->with(['data' => 'payment request sent successfully']);
            //code...
        } catch (\Throwable $th) {
         throw $th;
            DB::rollBack();
            return back()->with(['error' => 'Payment request not approved due to system error']);
        }
     

    }

    public function uploadCheckFile() {
        try {
            $fileName = time() . '.' . request()->file->extension();
            request()->file->move(public_path('payment/checks'), $fileName);
            return $fileName;
        } catch (Exception $e) {
          throw $e;
        }


    }

}


?>