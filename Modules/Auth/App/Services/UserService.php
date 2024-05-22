<?php
namespace Modules\Auth\App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Modules\Auth\App\DTOS\UserDTO;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function addUser(UserDTO $userDTO)
    {
        $user = User::create([
            'name' => $userDTO->name,
            'username' => $userDTO->username,
            'email' => $userDTO->email,
            'password' => Crypt::encrypt($userDTO->password),
            'phone' => $userDTO->phone,
            'balance' => $userDTO->balance,
        ]);
        return $user;
    }
    public function decreaseParentBalance(User $user, $amount)
    {
        $user = User::find($user->id);
        $user->balance = $user->balance - $amount;
        $user->save();
    }

    public function getUsersById(array $ids)
    {
        return User::whereIn("id", $ids)->paginate(2);
    }

    public function getUserWithCridential(UserDTO $userDTO)
    {
        return User::where("email", "=", $userDTO->username)->orWhere("phone", "=", $userDTO->username)->first();
    }

    public function clearAllResetTokens($user)
    {
        $user = User::where("id",'=',$user->id)->first();
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    }

    public function createResetToken(User $user) {
        $this->clearAllResetTokens($user);
        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $token,
        ]);
        return $token;
    }

    public function getUserByEmailOrPassword($data) {
        return User::where("email","=",$data)->orWhere("phone","=",$data)->first();
    }

    public function checkResetTokenIsset($token) {
        return  DB::table('password_reset_tokens')->where('token', $token)->first();
    }

    public function resetPassword($userId,$password) {
  
        $user =  User::find($userId);
        $user->password = Hash::make($password);
        $user->save();
        return $user;

    }

    public function getUserById($id) {
        return User::find($id);
    }

}


?>