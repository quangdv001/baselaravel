<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotelRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motel_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('floor');
            $table->string('max');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->smallInteger('status')->default(1);
            $table->bigInteger('motel_id');
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
        Schema::dropIfExists('motel_room');
    }
}
