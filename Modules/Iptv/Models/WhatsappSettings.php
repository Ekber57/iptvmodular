<?php
namespace Modules\Iptv\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappSettings extends Model
{
    use HasFactory;
    protected $table  = 'iptvmodule_whatsapp_settings';
    protected $fillable = [
        'user_id',
        'name',
        'content',
        'status',
    ];
}
