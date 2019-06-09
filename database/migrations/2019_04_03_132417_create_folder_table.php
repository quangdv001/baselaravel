<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default('New Folder');
            $table->integer('parent_id')->nullable()->default(0);
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
        Schema::dropIfExists('folder');
    }
}
