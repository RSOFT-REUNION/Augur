<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
use App\Models\Orders\Delivery;
use Illuminate\Database\Seeder;

class AugurSeeder extends Seeder
{
    public function run(): void
    {
        Delivery::create([
            'name' => 'Clic & Collect',
            'description' => 'Retrait en magasin',
            'image' => 'clic.collect.png',
            'price_ttc' => 0
        ]);
        Delivery::create([
            'name' => 'Liv\'Express',
            'description' => 'Livraison a domicile',
            'image' => 'livexpress.png',
            'price_ttc' => 10
        ]);
        Category::create([
            'name' => 'Produits surgelés',
            'erp_id_famille' => 'SURGELE',
            'slug' => 'produits-surgeles',
            'image' => 'produits.surgeles.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'Epicerie fine',
            'erp_id_famille' => 'EPICERIE',
            'slug' => 'epicerie-fine',
            'image' => 'epicerie.fine.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'Produits Vrac',
            'erp_id_famille' => 'VRAC',
            'slug' => 'produits-vrac',
            'image' => 'produits.vrac.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'Produits Péi',
            'erp_id_famille' => 'EPICERIPEI',
            'slug' => 'produits-pei',
            'image' => 'produits.pei.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'HANOSEC',
            'erp_id_famille' => 'HANOSEC',
            'slug' => 'HANOSEC',
            'image' => '',
            'active' => 0,
            'is_menu' => 0,
        ]);
        Category::create([
            'name' => 'HANOSURGEL',
            'erp_id_famille' => 'HANOSURGEL',
            'slug' => 'HANOSURGEL',
            'image' => '',
            'active' => 0,
            'is_menu' => 0,
        ]);
    }
}
