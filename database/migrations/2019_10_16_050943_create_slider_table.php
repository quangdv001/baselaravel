<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('slider', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('title');
        //     $table->string('img');
        //     $table->string('img_inside');
        //     $table->string('position');
        //     $table->smallInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('slider');
    }
}
