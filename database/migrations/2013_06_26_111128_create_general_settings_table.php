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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('site_active')->default(1);
            $table->integer('maintenance_type')->default(1);
            $table->string('site_version')->default("1.0.0");
            $table->text('legal_mention')->nullable();
            $table->text('conditions')->nullable();
            $table->string('main_email')->nullable();
            $table->string('main_phone')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_insta')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
