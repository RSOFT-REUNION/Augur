<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->nullable()->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('catalog_categories');
            $table->timestamps();
        });

        /*** Ajout des permision **/
        $permissions = [
            [
                'category' => 'Catalog',
                'group_name' => 'Categories',
                'permissions' => [
                    'catalog.categories.create',
                    'catalog.categories.update',
                    'catalog.categories.delete',
                ],
            ]
        ];
        addPermissions($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_categories');
    }
};
