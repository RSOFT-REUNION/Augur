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
    public function getFristImages($product)
    {
        $product= Product::where('id', $product->product_id)->first();
        if($product->fav_image){
            $fav_image = $product->images()->where('id', $product->fav_image)->first();
            if($fav_image){
                echo '<img class="img-fluid rounded-3" src="'.$fav_image->getImageUrl().'" alt="'. $product->name .'">';
            } else {
                echo '<img class="img-fluid rounded-3" src="'.$product->images[0]->getImageUrl().'" alt="'. $product->name .'">';
            }
        } elseif ($product->images->count() > 0) {
            echo '<img class="img-fluid rounded-3" src="'.$product->images[0]->getImageUrl().'" alt="'. $product->name .'">';
        }
    }
}
