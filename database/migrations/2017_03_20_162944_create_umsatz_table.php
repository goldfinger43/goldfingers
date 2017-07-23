<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUmsatzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umsaetze', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turnier_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->float('betrag');
            $table->string('soll_haben');
            $table->date('datum')->nullable();
            $table->string('verwendungszweck')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('turnier_id')->references('id')->on('turniere')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('umsaetze');
    }
}
