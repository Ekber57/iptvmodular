<?php
namespace Modules\Notification\Events;

use App\Models\User;

class CreateNotificationTypeEvent {
    public $user;
    public $type;
    public function __construct(User $user,string $type) {
        $this->user = $user;
        $this->type = $type;
    }
}


?>