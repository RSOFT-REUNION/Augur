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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->integer('state')->default(0);
            $table->string('title');
            $table->foreignId('media_id')->constrained('media', 'id');
            $table->text('description_short');
            $table->text('page_content')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('shop_id')->nullable()->constrained('shops', 'id');
            $table->boolean('all_shops')->default(0);
            $table->boolean('one_day')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
