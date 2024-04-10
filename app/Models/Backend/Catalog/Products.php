<?php

namespace App\Models\Backend\Catalog;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'catalog_products';

    protected $fillable = ['title', 'slug', 'category_id', 'image', 'description', 'price', 'size', 'user_id', 'user_id_update'];

    /**
     * Retourne le nom de la categorie
     */
    public function getCategoryName($category_id) {

        if(empty(Category::where('id', '=', $category_id)->pluck('name')->first())){
            return 'Aucune catégorie';
        } else {
            return Category::where('id', '=', $category_id)->pluck('name')->first();
        }
    }

}
