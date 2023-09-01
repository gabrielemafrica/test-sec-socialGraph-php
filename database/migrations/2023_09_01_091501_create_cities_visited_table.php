<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Definiamo una nuova classe Migration anonima
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creiamo la tabella 'cities_visited' con i seguenti campi
        Schema::create('cities_visited', function (Blueprint $table) {
            $table->id(); // Campo ID auto-incrementale

            $table->string('city_name'); // Campo per il nome della città
            $table->integer('rating');   // Campo per il punteggio/rating della città

            $table->timestamps(); // Campi per la data di creazione e aggiornamento
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminiamo la tabella 'cities_visited' se esiste
        Schema::dropIfExists('cities_visited');
    }
};
