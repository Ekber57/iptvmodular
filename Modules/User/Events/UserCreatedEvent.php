<?php 
namespace Modules\User\Events;

use App\Models\User;

class UserCreatedEvent {
    public $newUser;
    public $parentUser;

    public $currentUser;

    public $sendNotification;
    /**
 * Creates a new user.
 *
 * @param User $newUser The new created user
 * @param User $currentUser The user which create new user like current session user
 * @param User $parentUser The parent user 
 */
    public function __construct(User $newUser,User $currentUser = null,User $parentUser = null,bool $sendNotification = true) {
        $this->newUser = $newUser;
        $this->currentUser = $currentUser;
        $this->parentUser = $parentUser;
        $this->sendNotification = $sendNotification;
    }
}
?>