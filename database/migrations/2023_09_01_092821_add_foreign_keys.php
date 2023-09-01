<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities_visited', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');

            $table -> foreign('person_id')
                -> references('id')
                -> on('people');

        });

        Schema::table('connections', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('friend_id');

            $table -> foreign('person_id')
                -> references('id')
                -> on('people');

            $table -> foreign('friend_id')
                -> references('id')
                -> on('people');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities_visited', function (Blueprint $table) {
            $table -> dropForeign('cities_visited_person_id_foreign');
            $table -> dropColumn('person_id');
        });

        Schema::table('connections', function (Blueprint $table) {
            $table -> dropForeign('connections_person_id_foreign');
            $table -> dropColumn('person_id');
            $table -> dropForeign('connections_friend_id_foreign');
            $table -> dropColumn('friend_id');
        });
    }
};
