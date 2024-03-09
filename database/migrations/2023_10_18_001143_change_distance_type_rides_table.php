<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDistanceTypeRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->dropColumn('distance');
        });

        Schema::table('rides', function (Blueprint $table) {
            $table->string('distance')->nullable()->after('booked');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->dropColumn('distance');
        });

        Schema::table('rides', function (Blueprint $table) {
            $table->integer('distance')->nullable()->after('booked');        
        });
 
    }
}
