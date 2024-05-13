<?php

namespace App\Models\Catalog;

use App\Models\Carts\Carts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'catalog_products';

    protected $fillable = ['code_article', 'name', 'slug', 'category_id', 'brands', 'fav_image', 'description', 'composition', 'tags', 'weight_unit', 'weight', 'unite_vente', 'price_ht','tva','price_ttc','code_barre','real_stock','virtual_stock','active', 'created_by_id','updated_by_id', 'deleted_by_id' ];

    /**
     * Retourne le nom de la categorie
     */

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function brands (): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductsImages::class);
    }

/*    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }*/

    public function getCategoryName($category_id) {

        if(empty(Category::where('id', '=', $category_id)->pluck('name')->first())){
            return 'Aucune catégorie';
        } else {
            return Category::where('id', '=', $category_id)->pluck('name')->first();
        }
    }
    public function getFristImages(Product $product)
    {
        $return = '';
        if($product->fav_image){
            $fav_image = $product->images()->where('id', $product->fav_image)->first();
            if($fav_image){
                $return = '<img style="max-height: 50px;" src="'.$fav_image->getImageUrl().'" alt="'. $product->name .'">';
            } else {
                $return = '<img style="max-height: 50px;" src="'.$product->images[0]->getImageUrl().'" alt="'. $product->name .'">';
            }
        } elseif ($product->images->count() > 0) {
            $return = '<img style="max-height: 50px;" src="'.$product->images[0]->getImageUrl().'" alt="'. $product->name .'">';
        }
        echo $return;
    }

     public function attachImages($product, array $images)
     {
         $pictures = [];
         foreach ($images as $image) {
             if ($image->getError()){
                 continue;
             }
             $image_name = Str::slug($image->getClientOriginalName(), '.');
             $image->storeAs('public/upload/catalog/products/'.$product.'/', $image_name);
             $pictures[] = [
                 'name' => $image_name,
             ];
         }
         if(count($pictures) > 0){
             $this->Images()->createMany($pictures);
         }
     }
}
