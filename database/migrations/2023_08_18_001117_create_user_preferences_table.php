<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('preference_option_id');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('preference_option_id')->on('preference_options')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['preference_option_id']);
        });
        Schema::dropIfExists('user_preferences');
    }
}
