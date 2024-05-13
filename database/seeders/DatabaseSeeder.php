<?php

namespace Database\Seeders;

use App\Models\Catalog\Product;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SuperAdminSeeder::class,
        ]);
        User::create([
            'name' => 'Vienne Ludovic',
            'email' => 'technique@rsoft.re',
            'password' => Hash::make('pMg59f!*4D'),
            'email_verified_at' => now(),
        ]);
        $produit1 = Product::create([
            'name' => 'Produits Test 1',
            'slug' => 'produits-test-1',
            'description' => 'Produits Test 1',
            'price_ht' => 49,
            'tva' => 5,
            'price_ttc' => 59,
            'stock' => 5,
            'fav_image' => 1,
        ]);
        $produit1->images()->create([
            'name' => 'macos.rancho.cucamonga.2560x1440945764.mm.90.jpg',
        ]);

        $produit2 = Product::create([
            'name' => 'Produits Test 2',
            'slug' => 'produits-test-2',
            'description' => 'Produits Test 2',
            'price_ht' => 99,
            'tva' => 10,
            'price_ttc' => 149,
            'stock' => 0,
            'fav_image' => 2,
        ]);
        $produit2->images()->create([
            'name' => 'magnificent.landscape.2560x144075654.mm.90.jpg',
        ]);

        $produit3 = Product::create([
            'name' => 'Produits Test 3',
            'slug' => 'produits-test-3',
            'description' => 'Produits Test 3',
            'price_ht' => 29,
            'tva' => 20,
            'price_ttc' => 39,
            'stock' => 16,
            'fav_image' => 3,
        ]);
        $produit3->images()->create([
            'name' => 'reef.beach.australia.photography.2560x1440949495.mm.90.jpg',
        ]);
    }
}
