<?php

namespace App\Models\Backend\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shop extends Model
{
    protected $table = 'catalog_shops';

    protected $fillable = ['title', 'image', 'address', 'postal_code', 'city', 'description', 'schedules', 'visibility'];

    /**
     * Retourne l'adresse du magasin
     */
    public function getShopAddress($shop_id) {

        $shop = Shop::find($shop_id)->select('address','postal_code', 'city')->first();
        return $shop->address.' '.$shop->postal_code.' '.$shop->city;
    }

}
