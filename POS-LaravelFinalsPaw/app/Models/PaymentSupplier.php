<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSupplier extends Model
{
    protected $fillable = [
        'amount',
        'orderSupplier_id',
        'user_id',
    ];
    public function orderSupplier()
    {
        return $this->belongsTo(OrderSupplier::class);
    }
}
