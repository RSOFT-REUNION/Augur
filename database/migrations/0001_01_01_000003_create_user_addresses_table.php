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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('alias');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('other')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('other_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
