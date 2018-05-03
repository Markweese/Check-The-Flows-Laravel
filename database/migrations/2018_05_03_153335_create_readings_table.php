<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('station_id')->unsigned()->index();
          $table->integer('cfs')->nullable();
          $table->integer('ph')->nullable();
          $table->integer('temp')->nullable();
          $table->integer('conductance')->nullable();
          $table->dateTime('reading_time');
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
        Schema::dropIfExists('readings');
    }
}
