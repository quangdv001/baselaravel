<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('folder_id')->default(0);
            $table->string('name');
            $table->string('type');
            $table->string('path');
            $table->string('url');
            $table->integer('position')->nullable()->default(0);
            $table->integer('user_id_c')->nullable()->default(0);
            $table->string('user_name_c')->nullable();
            $table->integer('user_id_u')->nullable()->default(0);
            $table->string('user_name_u')->nullable();
            $table->integer('admin_id_c')->nullable()->default(0);
            $table->string('admin_name_c')->nullable();
            $table->integer('admin_id_u')->nullable()->default(0);
            $table->string('admin_name_u')->nullable();
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
        Schema::dropIfExists('file');
    }
}
