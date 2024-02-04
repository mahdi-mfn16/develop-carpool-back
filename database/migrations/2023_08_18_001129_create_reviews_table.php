<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ride_id');
            $table->unsignedBigInteger('rate_id');
            $table->text('text');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('ride_id')->on('rides')->references('id');
            $table->foreign('rate_id')->on('rates')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ride_id']);
            $table->dropForeign(['rate_id']);
        });
        Schema::dropIfExists('reviews');
    }
}
