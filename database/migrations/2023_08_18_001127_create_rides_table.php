<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('origin_city_id');
            $table->unsignedBigInteger('destination_city_id');
            $table->unsignedBigInteger('user_vehicle_id')->nullable();
            $table->text('origin_address')->nullable();
            $table->text('destination_address')->nullable();
            $table->string('origin_lng')->nullable();
            $table->string('origin_lat')->nullable();
            $table->string('destination_lng')->nullable();
            $table->string('destination_lat')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('booked')->default(0);
            $table->integer('distance')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('type')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->float('price')->default(0);
            $table->float('fee')->default(0);
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('origin_city_id')->on('cities')->references('id');
            $table->foreign('destination_city_id')->on('cities')->references('id');
            $table->foreign('user_vehicle_id')->on('user_vehicles')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['origin_city_id']);
            $table->dropForeign(['destination_city_id']);
            $table->dropForeign(['user_vehicle_id']);
        });
        Schema::dropIfExists('rides');
    }
}
