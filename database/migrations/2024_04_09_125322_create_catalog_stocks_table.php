<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('product_id')->references('id')->on('catalog_products')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('catalog_shops')->onDelete('cascade');
            $table->primary(['product_id', 'shop_id']);
            $table->integer('quantity_in_stock')->default(0);
            $table->integer('quantity_reserved')->default(0);
            $table->integer('quantity_sold')->default(0);
            $table->timestamps();
        });

        /*** Ajout des permision **/
        $permissions = [
            [
                'category' => 'Catalog',
                'group_name' => 'Stocks',
                'permissions' => [
                    'catalog.stocks.create',
                    'catalog.stocks.update',
                    'catalog.stocks.delete',
                ],
            ]
        ];
        addPermissions($permissions);
    }


    public function down(): void
    {
        Schema::dropIfExists('catalog_stocks');
    }
};
