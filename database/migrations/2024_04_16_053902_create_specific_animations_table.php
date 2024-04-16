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
        Schema::create('specific_animations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image');
            $table->longText('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('shops_id');
            $table->timestamps();
        });
        /*** Ajout des permision **/
        $permissions = [
            [
                'category' => 'Specifique',
                'group_name' => 'Animations',
                'permissions' => [
                    'specific.animations.create',
                    'specific.animations.update',
                    'specific.animations.delete',
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
        Schema::dropIfExists('specific_animations');
    }
};
