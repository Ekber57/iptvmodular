<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;
    protected $table = 'usermodule_bank_details';
    protected $fillable = [
        'user_id',
        'card_number',
        'bank_name',
        'customer'
    ];
}
