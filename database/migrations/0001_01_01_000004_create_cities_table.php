<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('city');
            $table->string('postal_code');
            $table->timestamps();
        });

        // Insert data
        DB::table('cities')->insert([
            ['country' => 'La Réunion', 'city' => 'Bras-Panon', 'postal_code' => '97412'],
            ['country' => 'La Réunion', 'city' => 'Cilaos', 'postal_code' => '97413'],
            ['country' => 'La Réunion', 'city' => 'Entre-Deux', 'postal_code' => '97414'],
            ['country' => 'La Réunion', 'city' => "L’Étang-Salé", 'postal_code' => '97427'],
            ['country' => 'La Réunion', 'city' => 'La Plaine-des-Palmistes', 'postal_code' => '97431'],
            ['country' => 'La Réunion', 'city' => 'La Possession', 'postal_code' => '97419'],
            ['country' => 'La Réunion', 'city' => 'Le Port', 'postal_code' => '97420'],
            ['country' => 'La Réunion', 'city' => 'Le Tampon', 'postal_code' => '97430'],
            ['country' => 'La Réunion', 'city' => 'Les Avirons', 'postal_code' => '97425'],
            ['country' => 'La Réunion', 'city' => 'Les Trois-Bassins', 'postal_code' => '97426'],
            ['country' => 'La Réunion', 'city' => 'Petite-Île', 'postal_code' => '97429'],
            ['country' => 'La Réunion', 'city' => 'Saint-André', 'postal_code' => '97440'],
            ['country' => 'La Réunion', 'city' => 'Saint-Benoît', 'postal_code' => '97470'],
            ['country' => 'La Réunion', 'city' => 'Saint-Denis', 'postal_code' => '97400'],
            ['country' => 'La Réunion', 'city' => 'Sainte-Anne', 'postal_code' => '97437'],
            ['country' => 'La Réunion', 'city' => 'Sainte-Marie', 'postal_code' => '97438'],
            ['country' => 'La Réunion', 'city' => 'Sainte-Rose', 'postal_code' => '97439'],
            ['country' => 'La Réunion', 'city' => 'Sainte-Suzanne', 'postal_code' => '97441'],
            ['country' => 'La Réunion', 'city' => 'Saint-Joseph', 'postal_code' => '97480'],
            ['country' => 'La Réunion', 'city' => 'Saint-Leu', 'postal_code' => '97436'],
            ['country' => 'La Réunion', 'city' => 'Saint-Louis', 'postal_code' => '97450'],
            ['country' => 'La Réunion', 'city' => 'Saint-Paul', 'postal_code' => '97460'],
            ['country' => 'La Réunion', 'city' => 'Saint-Gilles', 'postal_code' => '97434'],
            ['country' => 'La Réunion', 'city' => 'Saint-Philippe', 'postal_code' => '97442'],
            ['country' => 'La Réunion', 'city' => 'Saint-Pierre', 'postal_code' => '97410'],
            ['country' => 'La Réunion', 'city' => 'Salazie', 'postal_code' => '97433'],
        ]);

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country');
    }
};
