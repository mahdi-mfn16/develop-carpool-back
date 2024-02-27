<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLngToProvinceCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lng');
           
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lng');
           
        });
    }
}
