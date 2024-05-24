<?php
namespace Modules\Otp\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otpcode extends Model
{
    use HasFactory;
    protected $table = 'otpmodule_otpcodes';
    protected $fillable = [
        'status',
        'user_id',
        'code'
    ];
}
