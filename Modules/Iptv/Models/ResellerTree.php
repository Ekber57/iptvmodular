<?php
namespace Modules\Iptv\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerTree extends Model
{
    use HasFactory;
    protected $table = 'iptvmodule_reseller_trees';
    protected $fillable = [
     'parent',
     'child'
    ];

}
