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
        // Creiamo la tabella 'connections' con un campo 'id' e campi per le date di creazione e aggiornamento
        Schema::create('connections', function (Blueprint $table) {
            $table->id(); // Campo ID auto-incrementale

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
        // Eliminiamo la tabella 'connections' se esiste
        Schema::dropIfExists('connections');
    }
};
