<?php 
namespace Modules\WhatsappNotification\Events;
use Modules\WhatsappNotification\DTOS\WhatsappNotificationDTO;
class SendWhatsappNotificationEvent {
    public $whatsappNotificationDTO;
    public function __construct(WhatsappNotificationDTO $whatsappNotificationDTO) {
        $this->whatsappNotificationDTO = $whatsappNotificationDTO;
    }
}

?>