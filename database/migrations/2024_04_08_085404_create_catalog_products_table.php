<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->nullable()->unique();
            $table->integer('category_id')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('price')->nullable();
            $table->string('size')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('user_id_update')->nullable();
            $table->timestamps();
        });

        /*** Ajout des permision **/
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
