<?php

namespace Modules\Iptv\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTree extends Model
{
    use HasFactory;
    protected $table  = 'iptvmodule_user_trees';
    protected $fillable = [
        'child',
        'parent',
    ];
}
