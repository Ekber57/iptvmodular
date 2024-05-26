<?php 
namespace Modules\WhatsappNotification\Models;
use Illuminate\Database\Eloquent\Model;

class WhatsappNotificationBalance extends Model{
    protected $table = 'whatsappnotification_module_user_balance';
    protected $fillable = [
        'user_id',
        'balance'
    ];
}

?>