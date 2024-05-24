<?php 
namespace Modules\User\App\Actions;
use Modules\User\DTOS\UserDTO;
use Illuminate\Support\Facades\Auth;
use Modules\User\App\Services\UserService;

class UserAction {
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function storeUser() {
        $user = Auth::user()->id;
        $this->userService->clearUserInfo($user);
        request()->validate([
            'name' => 'required|string|min:3|max:100',
            'phone' => 'required|string|regex:/^[0-9]+$/|unique:users,phone',
            'email' => 'required|email|string|min:8|max:200|unique:users,email',
            'password' => 'required|min:5|max:30'
        ]);

        
        $userDTO = new UserDTO();
        $userDTO->id = $user;
        $userDTO->email = request()->email;
        $userDTO->phone = request()->phone;
        $userDTO->name = request()->name;
        $userDTO->password = request()->password;
        $this->userService->edit($userDTO);
        return redirect()->back()->with('data', 'Istifadeci melumatlari yenilendi.');
    }
    

}







?>