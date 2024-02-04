<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('notification_type_id');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('notification_type_id')->on('notification_types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notification_types', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['notification_type_id']);
        });
        Schema::dropIfExists('user_notification_types');
    }
}
