<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'barcode',
        'price',
        'quantity',
        'unit',
        'status'
    ];
    public function purchases()
    {
    return $this->belongsToMany(Purchase::class)->withPivot('quantity');
    }
    public function orderSupplierItems()
    {
        return $this->hasMany(OrderSupplierItem::class, 'product_id');
    }
    public function order()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
    public function total()
    {
        return $this->orderSupplierItems->map(function ($i){
            return $i->quantity;
        })->sum();
    }
    public function totalCart()
    {
        return $this->order->map(function ($i){
            return $i->quantity;
        })->sum();
    }
}
