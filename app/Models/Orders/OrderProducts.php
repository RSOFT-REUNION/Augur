<?php

namespace App\Models\Orders;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProducts extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'stock_unit',
        'weight',
        'weight_unit',
        'price_ht',
        'tva',
        'price_ttc',
        'quantity',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
