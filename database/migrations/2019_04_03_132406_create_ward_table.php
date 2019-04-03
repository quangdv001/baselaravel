<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code')->nullable()->default(0);
            $table->string('name')->nullable();
            $table->integer('district_id')->nullable()->default(0);
            $table->integer('district_code')->nullable()->default(0);
            $table->integer('province_id')->nullable()->default(0);
            $table->integer('province_code')->nullable()->default(0);
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
        Schema::dropIfExists('ward');
    }
}
