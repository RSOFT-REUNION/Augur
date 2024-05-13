<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->id();
            $table->string('code_article')->nullable(); //code EBP
            $table->string('name');
            $table->string('slug')->nullable();
            // généré par la migration catalog_categories: $table->foreignId(category_id)->nullable();
            $table->string('category_id')->nullable();
            // généré par la migration catalog_brands: $table->foreignId('brand_id')->nullable();
            $table->string('fav_image')->nullable();
            $table->longText('description')->nullable();
            $table->string('composition')->nullable();
            $table->string('tags')->nullable();
            $table->string('weight_unit')->default('Kilogramme'); // Kilogramme ou Litre
            $table->double('weight')->default('0.00');
            $table->string('unite_vente')->default('Unité'); // Unité de vente. valeurs possibles: Unité, ou  ou Litre, pour le vrac
            $table->integer('price_ht')->nullable();
            $table->integer('tva')->nullable();
            $table->integer('price_ttc')->nullable();
            $table->string('code_barre')->nullable();
            $table->float('stock')->default('0.000'); // stock réel dans EBP
            $table->boolean('active')->default(1);
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by_id')->nullable();
        });

        /*** Ajout des permissions **/
        $permissions = [
            [
                'category' => 'Catalog',
                'group_name' => 'Products',
                'permissions' => [
                    'catalog.products.create',
                    'catalog.products.update',
                    'catalog.products.delete',
                ],
            ]
        ];
        addPermissions($permissions);

    }


    public function down(): void
    {
        Schema::dropIfExists('catalog_products');
    }
};
