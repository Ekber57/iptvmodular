<?php
namespace Modules\Iptv\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bouquet extends Model
{
    use HasFactory;
    protected $fillable = [
        'bouquet_id',
        'name',
        'channels',
        'movies',
        'radios',
        'series',
        'order',
    ];
}
