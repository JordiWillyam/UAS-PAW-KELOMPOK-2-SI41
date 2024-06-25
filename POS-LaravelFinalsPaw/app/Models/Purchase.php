<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'user_purchase';
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productPurchases()
    {
        return $this->hasMany(ProductPurchase::class);
    }

    public function products()
    {
    return $this->belongsToMany(Product::class)->withPivot('price', 'quantity');
    }
}
