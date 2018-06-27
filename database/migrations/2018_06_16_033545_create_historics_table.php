<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->string('usgs_id')->unique()->index();
            $table->integer('year_start')->nullable();
            $table->integer('year_end')->nullable();
            $table->integer('mean_1')->nullable();
            $table->integer('max_1')->nullable();
            $table->integer('min_1')->nullable();
            $table->integer('mean_2')->nullable();
            $table->integer('max_2')->nullable();
            $table->integer('min_2')->nullable();
            $table->integer('mean_3')->nullable();
            $table->integer('max_3')->nullable();
            $table->integer('min_3')->nullable();
            $table->integer('mean_4')->nullable();
            $table->integer('max_4')->nullable();
            $table->integer('min_4')->nullable();
            $table->integer('mean_5')->nullable();
            $table->integer('max_5')->nullable();
            $table->integer('min_5')->nullable();
            $table->integer('mean_6')->nullable();
            $table->integer('max_6')->nullable();
            $table->integer('min_6')->nullable();
            $table->integer('mean_7')->nullable();
            $table->integer('max_7')->nullable();
            $table->integer('min_7')->nullable();
            $table->integer('mean_8')->nullable();
            $table->integer('max_8')->nullable();
            $table->integer('min_8')->nullable();
            $table->integer('mean_9')->nullable();
            $table->integer('max_9')->nullable();
            $table->integer('min_9')->nullable();
            $table->integer('mean_10')->nullable();
            $table->integer('max_10')->nullable();
            $table->integer('min_10')->nullable();
            $table->integer('mean_11')->nullable();
            $table->integer('max_11')->nullable();
            $table->integer('min_11')->nullable();
            $table->integer('mean_12')->nullable();
            $table->integer('max_12')->nullable();
            $table->integer('min_12')->nullable();
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
        Schema::dropIfExists('historics');
    }
}
