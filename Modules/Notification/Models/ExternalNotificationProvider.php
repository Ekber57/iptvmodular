<?php 
namespace Modules\Notification\Models;
use Illuminate\Database\Eloquent\Model;
class ExternalNotificationProvider extends Model{
    protected $table = 'notificationmodule_external_service_provider';
    protected $fillable = [
        'user_id',
        'provider_name'
    ];
}


?>