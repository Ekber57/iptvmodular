<?php
namespace Modules\Iptv\App\Services;

use App\Models\User;
use Modules\Iptv\Models\Line;
use Illuminate\Support\Carbon;
use Modules\Iptv\DTOS\LineDTO;
use Modules\Iptv\Models\UserTree;

class LineService {
    public function addLine(LineDTO $nntvLineDTO) {
        Line::create([
            "user_id" => $nntvLineDTO->userId,
            "owner_id" => $nntvLineDTO->ownerId,
            "package_id" => $nntvLineDTO->packageId,
            "password" => $nntvLineDTO->password,
            "username" => $nntvLineDTO->username,
            "bouquets" => json_encode($nntvLineDTO->bouquets),
            "package_name" => $nntvLineDTO->package_name,
            "exp_date" => $nntvLineDTO->expDate,
            "status" => 0
        ]);

        UserTree::create([
            'parent' => $nntvLineDTO->ownerId,
            'child' => $nntvLineDTO->userId
        ]);
    }

    public function getLinesForUser(User $user) {
        return User::join("iptvmodule_lines","iptvmodule_lines.owner_id","=","users.id")->select(["users.username as owner","users.id as uid","iptvmodule_lines.*"])->get();
    }
 
    public function createEmptyLine(User $user) {
        Line::create([
            "user_id" => $user->id,
            "owner_id" => 1,
            "package_id" => 0,
            "password" => '',
            "username" => $user->username,
            "bouquets" => json_encode([]),
            "package_name" => '',
            "status" => 0
        ]);


    }
    
    // public function getOwner(User $user,) {
    //     return Line::where("")
    // }


    public function getLinesForOnlain(array $ids) {
        return Line::whereIn("owner_id",$ids)->get();
    }

    public function getWillExpiredLines(User $user) {
        $expDate = Carbon::now()->addDays(3);
        return Line::where("owner_id","=",$user->id)->whereDate("exp_date","=",$expDate)->get();

    }

    public function getLine(User $user) {
        return Line::where("user_id","=",$user->id)->first();
    }

    public function getParent(User $user) {
        return UserTree::where('child',$user->id)->first();
    }
}



?>