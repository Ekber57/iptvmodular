<?php
namespace Modules\Iptv\App\Services;

use App\Models\User;
use Modules\Iptv\Models\Package;
use Modules\Iptv\DTOS\PackageDTO;

class PackageService {
    public function addPackage(PackageDTO $packageDTO) {
       
        return Package::create([
            "official_credits" => $packageDTO->officialCredits,
            "user_id" => $packageDTO->userId,
            'original_package_id' =>$packageDTO->original_package_id,
            'package_name' => $packageDTO->package_name,
            'original_official_credits' => $packageDTO->originalOfficialCredits,
            "bouquets" => $packageDTO->bouquets,
            "official_duration" => $packageDTO->officialDuration
        
        ]);
    }
    public function clear(User $user) {
        Package::where("user_id","=",$user->id)->delete();
    }

    public function getPackages(User $user) {
        $packages = [];
        foreach(Package::where("user_id","=",$user->id)->get() as $package) {
            $packageDTO = new PackageDTO();
            $packageDTO->package_name = $package->package_name;
            $packageDTO->officialCredits = $package->official_credits;
            $packageDTO->id = $package->id;
            $packageDTO->original_package_id = $package->original_package_id;
            $packageDTO->userId = $package->user_id;
            $packageDTO->originalOfficialCredits = $package->original_official_credits;
            $packageDTO->bouquets = json_decode($package->bouquets);
            $packageDTO->officialDuration = $package->official_duration;
            array_push($packages,$packageDTO);
        }
        return $packages;
    }

    public function getPackage($id) {
        return Package::find($id);
    }


}

?>