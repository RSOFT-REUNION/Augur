<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Catalog\Brand;


return new class extends Migration {
    public function up(): void
    {
        // Correspond au "Type de calcul" dans Augur EBP, mais nous parlerons de "règles de calcul" dans RCMS
        Schema::create('catalog_discounts_rules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->unique();
            $table->string('formula')->unique();
            $table->string('short_description')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        // ** LES PROMOTIONS **
        Schema::create('catalog_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignIdFor(\App\Models\Catalog\DiscountRule::class)->nullable()->constrained('catalog_discounts_rules');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        // Les produits rattachés à chaques promotions
        Schema::create('catalog_discounts_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Catalog\Discount::class)->constrained('catalog_discounts')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Catalog\Product::class)->constrained('catalog_products');
            $table->integer('base_price_ht')->default(0);
            $table->integer('base_price_ttc')->default(0);
            $table->integer('discounted_price_ht')->default(0);
            $table->integer('discounted_price_ttc')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });


        /*** Ajout des permissions **/
        $permissions = [
            [
                'category' => 'Catalog',
                'group_name' => 'Discounts',
                'permissions' => [
                    'catalog.discounts.create',
                    'catalog.discounts.update',
                    'catalog.discounts.delete',
                ],
            ]
        ];
        addPermissions($permissions);

        /*** Ajout d'une règle de calcul par défaut **/
        \App\Models\Catalog\DiscountRule::create(['name' => '20% TTC (par défaut)', 'formula' => 'price_TTC * (20/100)']);
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_discounts_products');
        Schema::dropIfExists('catalog_discounts');
        Schema::dropIfExists('catalog_discounts_rules');
    }
};
