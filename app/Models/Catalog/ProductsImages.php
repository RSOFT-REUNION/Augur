<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    use HasFactory;

    protected $table = 'catalog_products_images';

    protected $fillable = ['name'];

    public function getImageUrl()
    {
        return '/storage/upload/catalog/products/'.$this->product_id.'/'.$this->name;
    }
}
