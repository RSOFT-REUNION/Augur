<?php

use App\Models\Backend\Content\Pages;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->default('/');
            $table->integer('category_id')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('user_id_update')->nullable();
            $table->timestamps();
        });

        /*** Ajout des permision **/
        $permissions = [
            [
                'category' => 'Content',
                'group_name' => 'Pages',
                'permissions' => [
                    'content.pages.create',
                    'content.pages.update',
                    'content.pages.delete',
                ],
            ]
        ];
        addPermissions($permissions);

        /*** Ajout de la page d'accueil **/
        Pages::create(['user_id' => 1, 'title' => 'Accueil', 'slug' => '/', 'description' => 'Page d\'accueil']);

    }


    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
