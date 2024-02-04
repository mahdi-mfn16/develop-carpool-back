<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reported_user_id');
            $table->unsignedBigInteger('report_type_id');
            $table->text('text')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('reported_user_id')->on('users')->references('id');
            $table->foreign('report_type_id')->on('report_types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['reported_user_id']);
            $table->dropForeign(['report_type_id']);
        });
        Schema::dropIfExists('reports');
    }
}
