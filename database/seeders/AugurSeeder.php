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
            'slug' => 'produits-surgeles',
            'image' => 'produits.surgeles.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'Epicerie fine',
            'slug' => 'epicerie-fine',
            'image' => 'epicerie.fine.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'Produits Vrac',
            'slug' => 'produits-vrac',
            'image' => 'produits.vrac.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        Category::create([
            'name' => 'Produits Péi',
            'slug' => '	produits-pei',
            'image' => 'produits.pei.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
    }
}
