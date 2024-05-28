<?php

namespace App\Models\Carts;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CartsProducts extends Model
{
    Protected $table = 'carts_product';

    protected $fillable = ['product_id', 'cart_id', 'quantity', 'price_ht', 'tva','price_ttc'];

    public function Carts(): HasMany
    {
        return $this->hasMany(Carts::class);
    }
    public function getFirstImages($product, ?int $width = null, ?int $height = null, ?string $fit = null)
    {
        $product= Product::where('id', $product->product_id)->first();
        if($product->fav_image){
            $fav_image = $product->images()->where('id', $product->fav_image)->first();
            if($fav_image){
                return getImageUrl('/upload/catalog/products/'.$product->id.'/'.$fav_image->name, $width, $height, $fit);
            }
        } elseif ($product->images->count() > 0) {
            return getImageUrl('/upload/catalog/products/'.$product->id.'/'.$product->images->first()->name, $width, $height, $fit);
        }
    }
}
