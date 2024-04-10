<?php

namespace App\Models\Backend\Catalog;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'catalog_brands';

    protected $fillable = ['name', 'slug', 'image', 'description'];

    /**
     * Retourne le nom de la marque
     */
    public function getBrandName($category_id) {

        if(empty(Category::where('id', '=', $category_id)->pluck('name')->first())){
            return 'Aucune marque';
        } else {
            return Category::where('id', '=', $category_id)->pluck('name')->first();
        }
    }

}
