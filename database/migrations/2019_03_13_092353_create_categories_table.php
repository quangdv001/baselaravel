<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('class_name')->nullable();
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('type')->nullable()->default(0);
            $table->smallInteger('status')->nullable()->default(1);
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('position')->nullable()->default(0);
            $table->bigInteger('article_id')->nullable()->default(0);
            $table->bigInteger('single_page_id')->nullable()->default(0);
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
        Schema::dropIfExists('category');
    }
}
