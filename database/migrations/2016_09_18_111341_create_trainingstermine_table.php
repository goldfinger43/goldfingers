<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingstermineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainingstermine', function (Blueprint $table) {
            $table->increments('id');
            $table->date('datum');
            $table->string('bemerkung')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('training_id')->unsigned();
            $table->timestamps();

            $table->foreign('training_id')->references('id')->on('trainings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainingstermine');
    }
}
