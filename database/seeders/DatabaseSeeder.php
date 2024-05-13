<?php

namespace Database\Seeders;

use App\Models\Catalog\Product;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => 'breizh burger mini - spécial apéro',
            'slug' => Str::slug('breizh burger mini - spécial apéro'),
            'description' => 'Des mini burgers qui envoient du steak ! Un plaisir sans complexe avec ces 9 mini burgers 100% bretons ! Leur petit + : un pain délicatement moelleux au sarrasin. Une délicieuse recette pour un apéritif gourmand à partager en famille ou entre amis ! Conditionnement : 9x15g',
            'price_ht' => 490,
            'tva' => 5,
            'price_ttc' => 590,
            'stock' => 5,
        ]);

        $produit2 = Product::create([
            'name' => 'breizh burger',
            'slug' => Str::slug('breizh burger'),
            'description' => 'Quand l’Amérique s’invite aux portes de la Bretagne, saveurs et gourmandise sont au rendez-vous ! Succombez à la tentation de ce burger 100% breton ! Avis aux amateurs de snacking, son pain croustillant, sa compotée d’oignons et son steak tout droit venu de Bretagne vont vous régaler les papilles !',
            'price_ht' => 990,
            'tva' => 10,
            'price_ttc' => 1490,
            'stock' => 0,
        ]);

        $produit3 = Product::create([
            'name' => 'Coquillettes jambon vache qui rit',
            'slug' => Str::slug('Coquillettes jambon vache qui rit'),
            'description' => 'Un plat délicieux pour les enfants, rapide à préparer, avec de la viande de porc origine france',
            'price_ht' => 290,
            'tva' => 20,
            'price_ttc' => 390,
            'stock' => 16,
        ]);
    }
}
