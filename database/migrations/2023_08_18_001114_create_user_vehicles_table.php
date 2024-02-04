<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('color');
            $table->integer('year_model');
            $table->string('plate_number');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_vehicles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['vehicle_id']);
        });
        Schema::dropIfExists('user_vehicles');
    }
}
