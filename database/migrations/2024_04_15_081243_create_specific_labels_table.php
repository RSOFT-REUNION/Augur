<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('specific_labels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image');
            $table->longText('description')->nullable();
            $table->boolean('favorite')->default(0);
            $table->timestamps();
        });
        Schema::create('catalog_product_labels', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Catalog\Product::class)->constrained('catalog_products')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Specific\Labels::class)->constrained('specific_labels')->cascadeOnDelete();
            $table->primary(['product_id', 'labels_id']);
        });
        /*** Ajout des permision **/
        $permissions = [
            [
                'category' => 'Specifique',
                'group_name' => 'Labels',
                'permissions' => [
                    'specific.labels.create',
                    'specific.labels.update',
                    'specific.labels.delete',
                ],
            ]
        ];
        addPermissions($permissions);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specific_labels');
    }
};
