<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('mobile')->unique();
            $table->string('code')->nullable();
            $table->string('password')->nullable();
            // privilege  0 => free_user , 1 => vip_user,  10 => admin_user
            $table->integer('privilege')->default(0);
            $table->timestamp('birth_day')->nullable();
            $table->string('national_code')->nullable();
            // $table->unsignedBigInteger('province_id')->nullable();
            // $table->unsignedBigInteger('city_id')->nullable();
            $table->boolean('gender')->default(1);
            $table->text('about_me')->nullable();
            // status  0 => not_verified , 1 => national_code_verified , 2 => car_lisence_verified , 3 => deactive
            $table->boolean('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
