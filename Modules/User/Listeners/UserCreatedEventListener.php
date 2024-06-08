<?php
namespace Modules\User\Listeners;

use Modules\Events\SendNotificationEvent;
use Modules\User\Events\UserCreatedEvent;
class UserCreatedEventListener
{
    public function handle(UserCreatedEvent $userCreatedEvent)
    {
        if($userCreatedEvent->sendNotification == true) {
            if ($userCreatedEvent->currentUser == null) {
                $content = "Servere yeni " . $userCreatedEvent->newUser->name . " adli istifadeci qeydiyyat oldu. Istifadecinin username ve telefonu: " . $userCreatedEvent->newUser->username . " / " . $userCreatedEvent->newUser->phone;
                $title = "Yeni istifadaci qeydiyyat oldu";
                event(new SendNotificationEvent($userCreatedEvent->parentUser,$title,$content));
            }
    
           else  if ($userCreatedEvent->currentUser->id != 1 ) {
                $type = "istifadeci";
                if($userCreatedEvent->newUser->hasPermissionTo("iptv create line")) {
                    $type = "subreseller";
                }
                $content = "Sizin referaliniz olan ".$userCreatedEvent->currentUser->name." yeni ".$userCreatedEvent->newUser->name . " adli ".$type." yaratdi. Istifadecinin username ve telefonu: ".$userCreatedEvent->newUser->username." / ".$userCreatedEvent->newUser->phone;
                $title = "Yeni " .$type." yaradildi";
                event(new SendNotificationEvent($userCreatedEvent->parentUser,$title,$content));
            }
        }

    }


}


?>