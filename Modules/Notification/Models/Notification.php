<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table ='notificationmodule_notifications';
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status'
    ];
}
