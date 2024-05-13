<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Catalog\Category;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->nullable()->unique();
            $table->integer('level')->default(1);
            $table->foreignId('category_id')->nullable()->constrained('catalog_categories', 'id');
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
/*        Schema::table('catalog_products', function (Blueprint $table) {
            $table->foreignIdFor(Category::class)->after('name')->nullable()->constrained('catalog_categories');
        });*/

        /*** Ajout des permissions **/
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
/*        Schema::table('catalog_products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });*/
        Schema::dropIfExists('catalog_categories');
    }
};
