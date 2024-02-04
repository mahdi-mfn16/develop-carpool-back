<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id');
        //     $table->unsignedBigInteger('plan_id');
        //     $table->unsignedBigInteger('gateway_id');
        //     $table->string('payment_id')->nullable();
        //     $table->string('payment_code')->nullable();
        //     $table->string('payment_amount')->nullable();
        //     $table->timestamp('plan_expired_at')->nullable();
        //     $table->unsignedBigInteger('file_id')->nullable();
        //     $table->string('destination_number')->nullable();
        //     $table->string('destination_name')->nullable();
        //     $table->string('origin_number')->nullable();
        //     $table->text('description')->nullable();
        //     $table->boolean('is_confirmed')->default(0);
        //     $table->timestamp('payment_datetime')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('payments');
    }
}
