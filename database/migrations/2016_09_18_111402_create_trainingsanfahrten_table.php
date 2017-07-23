<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsanfahrtenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainingsanfahrten', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anzahl_mitfahrer');
            $table->time('abfahrt');
            $table->string('bemerkung')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('trainingstermin_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trainingstermin_id')->references('id')->on('trainingstermine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainingsanfahrten');
    }
}
