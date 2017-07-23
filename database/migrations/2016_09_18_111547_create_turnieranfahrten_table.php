<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnieranfahrtenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnieranfahrten', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anzahl_mitfahrer');
            $table->string('bemerkung')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('turnier_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('turnier_id')->references('id')->on('turniere');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnieranfahrten');
    }
}
