<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCheck extends Model
{
    use HasFactory;
    protected $table = 'paymentmodule_payment_checks';
    protected $fillable = [
        'file_name',
        'payment_id'
    ];
}
