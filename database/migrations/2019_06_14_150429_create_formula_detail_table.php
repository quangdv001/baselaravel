<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceFormulaDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('formula_id');
            $table->string('name');
            $table->bigInteger('start')->nullable();
            $table->bigInteger('end')->nullable();
            $table->smallInteger('type')->default(1);
            $table->integer('price')->unsigned();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('service_formula_detail');
    }
}
