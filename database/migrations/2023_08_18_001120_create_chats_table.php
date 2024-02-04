<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_one');
            $table->unsignedBigInteger('user_id_two');
            $table->timestamps();

            $table->foreign('user_id_one')->on('users')->references('id');
            $table->foreign('user_id_two')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['user_id_one']);
            $table->dropForeign(['user_id_two']);
        });
        Schema::dropIfExists('chats');
    }
}
