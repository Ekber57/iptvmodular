<?php 
namespace Modules\Notification\Models;
use Illuminate\Database\Eloquent\Model;
class ExternalNotificationServiceBalance extends Model{
    protected $table = 'notificationmodule_external_notification_service_for_user';
    protected $fillable = [
        'service_name',
        'status',
        'user_id'
    ];
}
?>