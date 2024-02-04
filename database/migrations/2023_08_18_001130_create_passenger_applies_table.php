<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengerAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passenger_applies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ride_id');
            $table->integer('capacity');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('ride_id')->on('rides')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passenger_applies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ride_id']);
        });
        Schema::dropIfExists('passenger_applies');
    }
}
