<?php

namespace App\Models\Orders;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProducts extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'products_id',
        'quantity',
    ];

    public function products()
    {
        return $this->hasOne(Product::class);
    }
}
