<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
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
        User::create([
            'name' => 'Amélie Comte',
            'email' => 'dev@rsoft.re',
            'password' => Hash::make('@Amc$2024**'),
            'email_verified_at' => now(),
        ]);
        Category::create([
            'name' => 'Produits surgelés',
            'slug' => 'produits-surgeles',
            'image' => 'produits.surgeles.jpg',
            'active' => 1,
            'is_menu' => 1,
        ]);
        $produit1 = Product::create([
            'name' => 'Produits Test 1',
            'slug' => 'produits-test-1',
            'category_id' => 1,
            'short_description' => 'Produits Test 1',
            'content' => 'Produits Test 1',
            'composition' => '',
            'tags' => '',
            'barcode' => '',
            'weight_unit' => 'kg',
            'weight' => '123',
            'price_ht' => 2990,
            'tva' => '0',
            'price_ttc' => 2990,
            'stock' => 5000,
            'stock_unit' => 'unit',
            'fav_image' => 1,
        ]);
        $produit1->images()->create([
            'name' => 'gratin.4.legumes.emmental.380g.jpg',
        ]);

        $produit2 = Product::create([
            'name' => 'Produits Test 2',
            'slug' => 'produits-test-2',
            'category_id' => 1,
            'short_description' => 'Produits Test 2',
            'content' => 'Produits Test 2',
            'composition' => '',
            'tags' => '',
            'barcode' => '',
            'weight_unit' => 'kg',
            'weight' => 341,
            'price_ht' => 590,
            'tva' => '0',
            'price_ttc' => 590,
            'stock' => 0,
            'stock_unit' => 'unit',
            'fav_image' => 2,
        ]);
        $produit2->images()->create([
            'name' => 'bzh.burger.x2.jpg',
        ]);

        $produit3 = Product::create([
            'name' => 'Produits Test 3',
            'slug' => 'produits-test-3',
            'category_id' => 1,
            'short_description' => 'Produits Test 3',
            'content' => 'Produits Test 3',
            'composition' => '',
            'tags' => '',
            'barcode' => '',
            'weight_unit' => 'kg',
            'weight' => 342,
            'price_ht' => 1990,
            'tva' => '0',
            'price_ttc' => 1990,
            'stock' => 1600,
            'stock_unit' => 'kg',
            'fav_image' => 3,
        ]);
        $produit3->images()->create([
            'name' => 'coquillettes.jambon.vache.qui.rit.800g.jpg',
        ]);
    }
}
