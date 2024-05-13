<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('session_id');
            $table->enum('status', ['En cours', 'Abandoner', 'Commander'])->default('En cours');
            $table->string('delivery_id')->nullable();
            $table->string('delivery_price')->nullable();
            $table->string('total_ttc')->nullable();
            $table->timestamps();
        });
        Schema::create('carts_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Catalog\Product::class)->constrained('catalog_products');
            $table->foreignIdFor(\App\Models\Carts\Carts::class)->constrained();
            $table->integer('quantity')->default(1);
            $table->integer('price_ht')->default(0);
            $table->integer('tva')->default(0);
            $table->integer('price_ttc')->default(0);
            $table->timestamps();
        });

        /*** Ajout des permisions **/
        $permissions = [
            [
                'category' => 'Clients',
                'group_name' => 'Paniers',
                'permissions' => [
                    'clients.carts.show',
                ],
            ]
        ];
        addPermissions($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('carts_product');
    }
};
