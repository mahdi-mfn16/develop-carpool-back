<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(0);
            $table->timestamps();

            $table->foreign('from_user_id')->on('users')->references('id');
            $table->foreign('to_user_id')->on('users')->references('id');
            $table->foreign('chat_id')->on('chats')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['from_user_id']);
            $table->dropForeign(['to_user_id']);
            $table->dropForeign(['chat_id']);
        });
        Schema::dropIfExists('messages');
    }
}
