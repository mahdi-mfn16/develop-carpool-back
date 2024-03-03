<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ride_id');
            $table->string('name')->nullable();
            $table->text('coordinates')->nullable();
            $table->integer('route_index')->nullable();
            $table->string('time')->nullable();
            $table->string('distance')->nullable();
            $table->timestamps();

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
        Schema::table('directions', function (Blueprint $table) {
            $table->dropForeign(['ride_id']);
        });
        Schema::dropIfExists('directions');
    }
}
