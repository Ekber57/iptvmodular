<?php  
namespace Modules\User\App\Services;
use App\Models\User;
use Modules\User\DTOS\UserDTO;
use Illuminate\Support\Facades\Crypt;


class UserService {
    public function edit(UserDTO $userDTO) {
        $user = User::find($userDTO->id);
        $user->name = $userDTO->name;
        $user->phone = $userDTO->phone;
        $user->email  = $userDTO->email;
        $user->password = Crypt::encrypt($userDTO->password);
        return $user->save();
    }

    public function clearUserInfo($id) {
        $user = User::find($id);
        $user->phone = "";
        $user->email = "";
        $user->save();
    }
}



?>