<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_translation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('page_id');
            $table->string('locale')
            $table->string('title')
            $table->string('slug')->nullable();
            $table->string('meta')->nullable();
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
        Schema::dropIfExists('page_translation');
    }
}
