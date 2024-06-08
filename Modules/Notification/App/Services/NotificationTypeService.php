<?php 
namespace Modules\Notification\App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Notification\Models\NotificationType;


class NotificationTypeService {
    public function addType(array $notificationTypeDTOs) {

        foreach ($notificationTypeDTOs as $notificationTypeDTO) {
            NotificationType::create([
                'user_id' => $notificationTypeDTO->userId,
                'type' => $notificationTypeDTO->type,
                'permission' => $notificationTypeDTO->permission,
                'definition' => $notificationTypeDTO->definition,
                'status' => 1,
            ]);
        }
    }

    public function getNotificationParametrs(User $user) {
       return  NotificationType::where('user_id',$user->id)->orderBy("type")->get();
    }

    public function changeStatus($userId,$ids) {
        NotificationType::where('user_id',$userId)->update(['status'=> 0 ]);
        if($ids != null) {
            NotificationType::whereIn('id',$ids)->update(['status'=> 1 ]);
        }
       
    }
}

?>