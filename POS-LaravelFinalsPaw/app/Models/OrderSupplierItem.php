<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSupplierItem extends Model
{
    protected $table = 'ordersupplier_items';
    protected $fillable =[

        'price',
        'quantity',
        'ordersupplier_id',
        'product_id',
        'order_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function orderSupplier()
    {
        return $this->belongsTo(OrderSupplier::class, 'ordersupplier_id'); // pastikan kolom ini benar
    }
    public function getProductName(){
        if($this->product) {
            return $this->product->name;
        }
        return 'p';
    }
}
