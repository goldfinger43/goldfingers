<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurniereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turniere', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('von_datum');
            $table->date('bis_datum');
            $table->string('strasse_nr')->nullable();
            $table->string('ort')->nullable();
            $table->string('plz')->nullable();
            $table->string('land')->nullable();
            $table->text('beschreibung')->nullable();
            $table->float('teamfee')->nullable()->default(0);
            $table->float('playersfee')->nullable()->default(0);
            $table->string('untergrund');
            $table->string('indoor_outdoor')->nullable();
            $table->string('slug');
            $table->string('status')->default('nicht angemeldet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turniere');
    }
}
