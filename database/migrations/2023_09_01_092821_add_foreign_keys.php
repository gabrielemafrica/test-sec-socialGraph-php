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
        // Aggiungiamo una colonna 'person_id' di tipo unsignedBigInteger alla tabella 'cities_visited'
        Schema::table('cities_visited', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');

            // Definiamo la chiave esterna per la colonna 'person_id' riferita alla tabella 'people'
            $table->foreign('person_id')
                ->references('id')
                ->on('people');
        });

        // Aggiungiamo due colonne 'person_id' e 'friend_id' di tipo unsignedBigInteger alla tabella 'connections'
        Schema::table('connections', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('friend_id');

            // Definiamo le chiavi esterne per le colonne 'person_id' e 'friend_id' riferite alla tabella 'people'
            $table->foreign('person_id')
                ->references('id')
                ->on('people');

            $table->foreign('friend_id')
                ->references('id')
                ->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminiamo la colonna 'person_id' e la chiave esterna associata dalla tabella 'cities_visited'
        Schema::table('cities_visited', function (Blueprint $table) {
            $table->dropForeign('cities_visited_person_id_foreign');
            $table->dropColumn('person_id');
        });

        // Eliminiamo le colonne 'person_id' e 'friend_id' e le chiavi esterne associate dalla tabella 'connections'
        Schema::table('connections', function (Blueprint $table) {
            $table->dropForeign('connections_person_id_foreign');
            $table->dropColumn('person_id');
            $table->dropForeign('connections_friend_id_foreign');
            $table->dropColumn('friend_id');
        });
    }
};
