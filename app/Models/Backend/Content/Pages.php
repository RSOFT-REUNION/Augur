<?php

namespace App\Models\Backend\Content;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'content_pages';

    protected $fillable = ['title', 'slug', 'category_id', 'image', 'description', 'content', 'user_id', 'user_id_update'];

    /**
     * Retourne le nom de la categorie
     */
    public function getCategoryName($categorie_id) {

        if(empty(Category::where('id', '=', $categorie_id)->pluck('name')->first())){
            return 'Aucune catégorie';
        } else {
            return Category::where('id', '=', $categorie_id)->pluck('name')->first();
        }
    }

}
