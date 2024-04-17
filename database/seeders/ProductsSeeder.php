<?php

namespace Database\Seeders;

use App\Models\Backend\Catalog\Products;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Products::create([
            'title' => 'breizh burger mini - spécial apéro',
            'slug' => 'breizh-burger-mini---special-apero',
            'image'=> '',
            'description' => 'Des mini burgers qui envoient du steak ! Un plaisir sans complexe avec ces 9 mini burgers 100% bretons ! Leur petit + : un pain délicatement moelleux au sarrasin. Une délicieuse recette pour un apéritif gourmand à partager en famille ou entre amis ! Conditionnement : 9x15g',
            'price' => '8,80€',
            'size' => '9x15g'
        ]);

        Products::create([
            'title' => 'SAUCE POIVRONADE (200G) CHAMPLAT',
            'slug' => 'sauce-poivronade-(200g)-champlat',
            'image'=> '',
            'price' => '2,50€',
            'size' => '200g'
        ]);

        Products::create([
            'title' => 'jus de citron péi LÈS PARLÉ 25cl',
            'slug' => 'jus-de-citron-pei-les-parle-25cl',
            'image'=> '',
            'description' => 'Lès Parlé est une gamme 100% pur jus de fruits péi, de saison, sans ajout d\'additifs, de conservateurs, ni de sucre. Ici notre jus est décliné en 100% jus de citron péi, de L\'île de La Réunion Nous laissons la parole aux fruits! Nous laissons la parole au goût! C\'est ça, Lès Parlé !',
            'price' => '2,80€',
            'size' => '25cl'
        ]);
    }
}
