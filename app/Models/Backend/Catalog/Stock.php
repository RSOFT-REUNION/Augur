<?php

namespace App\Models\Backend\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stock extends Model
{
    protected $table = 'catalog_stocks';

    protected $fillable = ['id', 'product_id', 'shop_id', 'quantity_in_stock', 'quantity_reserved', 'quantity_sold'];


}
