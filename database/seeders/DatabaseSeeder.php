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
            AugurSeeder::class,
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
            'name' => 'Gratin 4 légumes emmental',
            'slug' => 'gratin-4-legumes-emmental',
            'category_id' => 1,
            'short_description' => 'Gratin de 4 légumes et emmental BIO Association de légumes gourmands et emmental fondant dans une recette BIOtifulement bonne !',
            'content' => 'Gratin de 4 légumes et emmental BIO Association de légumes gourmands et emmental fondant dans une recette BIOtifulement bonne ! Un gratin riche en saveurs, avec son alliance de légumes BIO ! Une touche de brocoli, quelques carottes et des pommes de terre, le tout parsemé d’emmental Français gratiné ! Une recette idéale pour toute la famille ! Conditionnement : 380g',
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
            'name' => 'Breizh Burger',
            'slug' => 'breizh-burger',
            'category_id' => 1,
            'short_description' => 'Quand l’Amérique s’invite aux portes de la Bretagne, saveurs et gourmandise sont au rendez-vous !',
            'content' => 'Quand l’Amérique s’invite aux portes de la Bretagne, saveurs et gourmandise sont au rendez-vous ! Succombez à la tentation de ce burger 100% breton ! Avis aux amateurs de snacking, son pain croustillant, sa compotée d’oignons et son steak tout droit venu de Bretagne vont vous régaler les papilles !',
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
            'name' => 'Coquillettes jambon vache qui rit',
            'slug' => 'coquillettes-jambon-vache-qui-rit',
            'category_id' => 1,
            'short_description' => 'Un plat délicieux pour les enfants, rapide à préparer, avec de la viande de porc origine france',
            'content' => 'content : Un plat délicieux pour les enfants, rapide à préparer, avec de la viande de porc origine france',
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
