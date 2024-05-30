<?php  
namespace Modules\Events;

use App\Models\User;

class SendNotificationEvent {
    public User $user;
    public $title;
    public $content;
  /**
 * Creates a new user.
 *
 * @param User $user User which receive notification 
 * @param $title Notification title
 * @param $content Notification title
 */
    public function __construct(User $user,$title,$content) {
        $this->user = $user;
        $this->title = $title;
        $this->content = $content;
    }
}

?>