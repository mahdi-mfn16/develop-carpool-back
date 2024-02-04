<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('text')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

        });

        Schema::table('report_types', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('report_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_types', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('report_types');
    }
}
