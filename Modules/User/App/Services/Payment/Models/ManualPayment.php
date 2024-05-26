<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualPayment extends Model
{
    use HasFactory;
    protected $table = 'paymentmodule_manual_payments';
    protected $fillable = [
        'user_id',
        'status',
        'amount'
    ];
}
