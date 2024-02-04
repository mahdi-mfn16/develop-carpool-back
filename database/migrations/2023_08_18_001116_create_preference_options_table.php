<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preference_id');
            $table->string('text')->nullable();
            $table->timestamps();

            $table->foreign('preference_id')->on('preferences')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preference_options', function (Blueprint $table) {
            $table->dropForeign(['preference_id']);
        });
        Schema::dropIfExists('preference_options');
    }
}
