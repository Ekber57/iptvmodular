<?php
namespace Modules\Iptv\App\Actions;

use Exception;
use App\Models\User;
use Illuminate\Support\Carbon;
use Modules\Iptv\App\Services\ResellerService;
use Modules\Iptv\DTOS\LineDTO;
use Illuminate\Support\Facades\DB;
use Modules\Auth\App\DTOS\UserDTO;
use Modules\Iptv\DTOS\CashbackDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Modules\Iptv\DTOS\UserBindingDTO;
use Modules\Iptv\Events\LineCreatedEvent;
use Modules\Iptv\Models\ResellerTree;
use Modules\Iptv\externalAPIs\LinesAPI;
use Modules\Auth\App\Services\UserService;
use Modules\Iptv\App\Services\LineService;
use Modules\Iptv\externalAPIs\PackagesAPI;
use Modules\Iptv\App\Services\PackageService;
use Modules\Iptv\App\Services\CashbackService;
use Modules\Iptv\App\Services\UserBindingService;
use Modules\Iptv\App\Http\Requests\LineCreateRequest;
use Modules\User\Events\UserCreatedEvent;





class LineAction
{
    protected $userService;
    protected $lineService;
    protected $packageService;
    protected $linesAPI;
    protected $packagesAPI;
    protected $userBindingService;
    protected $packageAction;
    protected $cashbackService;
    protected $resellerService;
    public function __construct( 
        ResellerService $resellerService,
        CashbackService $cashbackService,
        UserBindingService $userBindingService,
        UserService $userService,
        PackageAction $packageAction,
        PackageService $packageService,
        LineService $lineService, PackagesAPI $packagesAPI, LinesAPI $linesAPI)
    {
        $this->resellerService =  $resellerService;
        $this->cashbackService = $cashbackService;
        $this->packageAction = $packageAction;
        $this->userService = $userService;
        $this->linesAPI = $linesAPI;
        $this->packagesAPI = $packagesAPI;
        $this->lineService = $lineService;
        $this->packageService = $packageService;
        $this->userBindingService = $userBindingService;
    }
    public function getPackages()
    {
        $customPackages = [];
        $key = env("priceKey");
        // if(Auth::user()->hasPermissionTo("iptv create subreseller")) {
        //     $packages = $this->packageAction->getPackagesForSubreseller();
         
        //     foreach($packages as $package) {
        //         $encodedPrice = Crypt::encryptString($package->officialCredits,$key);
        //         $package->enc_price = $encodedPrice;
        //         $package->bouquets = json_decode($package->bouquets);
        //         array_push($customPackages,$package);
        //      }
        // }
  
 
        if(Auth::user()->hasPermissionTo("iptv create subreseller")) {
            $packages = $this->packagesAPI->getPackages();

        foreach($packages as $package) {
       
        if($package->is_trial == "0") {
            $encodedPrice = Crypt::encryptString($package->official_credits,$key);
            $package->enc_price = $encodedPrice;
            array_push($customPackages,$package);
        }
        }
        }
 
     else {
        $packages = $this->packageService->getPackages(Auth::user());
       
        foreach($packages as $package) {
       
            $encodedPrice = Crypt::encryptString($package->officialCredits);
            $package->enc_price = $encodedPrice;
            $package->bouquets = json_decode($package->bouquets);
            array_push($customPackages,$package);
        }
        }




   
        return $customPackages;
      
    }


    public function addLine(LineCreateRequest $lineCreateRequest)
    {

        $expDate = Carbon::now();
        $expDate->addMonth($lineCreateRequest->official_duration);
        DB::beginTransaction();
        try {
            $lineDTO = new LineDTO();
            $lineDTO->ownerId = Auth::user()->id;
            $lineDTO->expDate = $expDate;
            $selectedBouquets = [];
            $lineDTO->packageId  = $lineCreateRequest->package_id;
        
            $lineDTO->bouquets = $lineCreateRequest->bouquets_selected;

            
            



            $lineDTO->username = $lineCreateRequest->username;
            $lineDTO->password = $lineCreateRequest->password;
            $lineDTO->package_name = $lineCreateRequest->package_name;
            $userDTO = new UserDTO();
            $userDTO->name = $lineCreateRequest->name;
            $userDTO->username = $lineCreateRequest->username;
            $userDTO->email = $lineCreateRequest->username."@brendtv.mail";
            $userDTO->phone = $lineCreateRequest->phone;
            $userDTO->password = $lineCreateRequest->password;
            $userDTO->balance = 0;
            $lineDTO->bouquets = [];
            foreach($lineCreateRequest->bouquets_selected as $bouquet) {
                $id = explode("|",$bouquet)[0];
                $name = explode("|",$bouquet)[1];
                array_push($lineDTO->bouquets,$id);
                array_push($selectedBouquets,[
                    "id" => $id,
                    "name" => $name
                ]);
            }
            $lineDTO->bouquets  = $selectedBouquets;
            $user = $this->userService->addUser($userDTO);
            $lineDTO->userId = $user->id;
            $line = $this->lineService->addLine($lineDTO);
           
            $lineDTO->bouquets = $lineCreateRequest->bouquets_selected;

            


            $lineDTO->ownerId = $this->userBindingService->getRemoteId(Auth::user()->id);
            // $remote_id  = $this->linesAPI->createLine($lineDTO)["data"]["id"];
            $remote_id  = 4545;

            $userBindingDTO = new UserBindingDTO();
            $userBindingDTO->localId = $user->id;
            $userBindingDTO->remoteId = $remote_id;
            $this->userBindingService->addBinding($userBindingDTO);
            $this->addCashback($lineCreateRequest);


            $parent = $this->userService->getUserById($this->resellerService->getParent(Auth::user()->id));
            event(new UserCreatedEvent($user,Auth::user(),$parent));


            DB::commit();
            $data = ['message' => 'Istifadeci yardildi'];

            // Flash the data to the session
            session()->flash('data', $data);
            return redirect()->route('create_line');
        }
        catch( Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function addCashback(lineCreateRequest $req) {
       if(!Auth::user()->hasPermissionTo("iptv create subreseller")){
        $parent = ResellerTree::where("child","=",Auth::user()->id)->first();
        $parent = User::find($parent->parent);
        $package = $this->packageService->getPackage($req->package_id);
        $amount = $package->official_credits - $package->original_official_credits;
        $cashbackDTO = new CashbackDTO();
        $cashbackDTO->userId = $parent->id;
        $cashbackDTO->amount = $amount;
        $this->cashbackService->giveCashback($cashbackDTO);
        $this->userService->decreaseParentBalance(Auth::user(),$package->official_credits);
        }
    }

    public function getLines(User $user) {
        return $local_lines  = $this->lineService->getLinesForUser($user);
        
    }


    public function getWillExpiredLines() {
        return $this->lineService->getWillExpiredLines(Auth::user());
    }




}
