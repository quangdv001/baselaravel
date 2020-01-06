<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('total');
            $table->smallInteger('status')->default(1);
            $table->bigInteger('bill_id');
            $table->bigInteger('service_id');
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
        Schema::dropIfExists('bill_service');
    }
}
