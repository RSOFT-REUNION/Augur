<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DiscountProduct extends Model
{
    use HasFactory;
    protected $table = 'catalog_discounts_details';
    protected $fillable = ['discount_id', 'product_id'];

    public function discount(): hasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function product(): hasOne
    {
        return $this->hasOne(Product::class);
    }

}
