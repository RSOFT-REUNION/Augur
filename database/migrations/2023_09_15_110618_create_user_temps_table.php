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
        Schema::create('user_temps', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('newsletter')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_temps');
    }
};
