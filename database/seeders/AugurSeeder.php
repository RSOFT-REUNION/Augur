<?php

namespace Database\Seeders;

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
    }
}
