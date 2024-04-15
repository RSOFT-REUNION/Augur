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
            $table->timestamps();
        });
        /*** Ajout des permision **/
        $permissions = [
            [
                'category' => 'Specifique',
                'group_name' => 'LabelsController',
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
