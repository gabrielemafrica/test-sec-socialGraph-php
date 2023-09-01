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
        // Creiamo la tabella 'people' con i seguenti campi
        Schema::create('people', function (Blueprint $table) {
            $table->id(); // Campo ID auto-incrementale

            $table->string('firstName'); // Campo per il nome
            $table->string('surname');   // Campo per il cognome
            $table->integer('age')->nullable(); // Campo per l'età (può essere nullo)
            $table->string('gender');   // Campo per il genere (maschio o femmina)

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
        // Eliminiamo la tabella 'people' se esiste
        Schema::dropIfExists('people');
    }
};

