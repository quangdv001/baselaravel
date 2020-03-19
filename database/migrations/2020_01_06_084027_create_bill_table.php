<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('note');
            $table->integer('room_price');
            $table->integer('other_price');
            $table->integer('service_price');
            $table->integer('debit_price');
            $table->integer('discount_price');
            $table->integer('total_price');
            $table->smallInteger('status')->default(1);
            $table->bigInteger('contract_id');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('bill');
    }
}
