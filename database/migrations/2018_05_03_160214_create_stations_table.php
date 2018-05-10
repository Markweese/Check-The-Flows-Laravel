<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('usgs_id')->unique()->index();
            $table->integer('huc8')->unsigned();
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->integer('state_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('station_user', function (Blueprint $table) {
            $table->integer('station_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['station_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
        Schema::dropIfExists('station_user');
    }
}
