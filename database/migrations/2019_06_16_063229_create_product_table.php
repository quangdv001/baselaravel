<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta')->nullable();
            $table->string('img')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->smallInteger('type')->default(1);
            $table->smallInteger('status')->default(1);
            $table->string('color')->nullable();
            $table->string('material_id')->default(0);
            $table->string('material')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('style')->nullable();
            $table->integer('width')->nullable()->default(0);
            $table->integer('height')->nullable()->default(0);
            $table->integer('depth')->nullable()->default(0);
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
        Schema::dropIfExists('product');
    }
}
