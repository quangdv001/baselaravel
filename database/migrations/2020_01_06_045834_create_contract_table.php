<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('note');
            $table->integer('deposits');
            $table->integer('duration');
            $table->integer('payment_period');
            $table->integer('start');
            $table->integer('end');
            $table->smallInteger('status')->default(1);
            $table->bigInteger('customer_id');
            $table->bigInteger('user_id');
            $table->bigInteger('motel_room_id');
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
        Schema::dropIfExists('contract');
    }
}
