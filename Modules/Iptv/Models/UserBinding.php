<?php
namespace Modules\Iptv\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBinding extends Model
{
    use HasFactory;
    protected $table = 'iptvmodule_user_bindings';
    protected $fillable = [
        'local_id',
        'remote_id'
    ];
    
}
