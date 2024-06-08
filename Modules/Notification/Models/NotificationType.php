<?php 
namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model {
protected $table = 'notificationmodule_notification_type';
protected $fillable = [
    'user_id',
    'type',
    'permission',
    'status',
    'definition'
];
}
?>