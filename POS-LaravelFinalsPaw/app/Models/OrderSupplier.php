<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSupplier extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'user_id'];

    public function items()
    {
        return $this->hasMany(OrderSupplierItem::class,'ordersupplier_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentSupplier::class,'ordersupplier_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getSupplierName()
    {
        if($this->supplier) {
            return $this->supplier->name;
        }
        return 'CASH';
    }
    public function getProducts()
    {
        return $this->orderSupplierItems()->with('product')->get()->pluck('product');
    }
    public function total()
    {
        return $this->items->map(function ($i){
            return $i->price;
        })->sum();
    }
    public function totalQuantity()
    {
        return $this->items->map(function ($i){
            return $i->quantity;
        })->sum();
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }
    public function receivedAmount()
    {
        $payments = $this->paymentsupplier ?? collect();

        return $payments->map(function ($i){
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }
}
