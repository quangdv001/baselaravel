<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta')->nullable();
            $table->string('img')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->smallInteger('type')->nullable()->default(0);
            $table->smallInteger('status')->nullable()->default(1);
            $table->integer('category_id')->nullable()->default(0);
            $table->integer('user_id_c')->nullable()->default(0);
            $table->string('user_name_c')->nullable();
            $table->integer('user_id_u')->nullable()->default(0);
            $table->string('user_name_u')->nullable();
            $table->integer('admin_id_c')->nullable()->default(0);
            $table->string('admin_name_c')->nullable();
            $table->integer('admin_id_u')->nullable()->default(0);
            $table->string('admin_name_u')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('law');
    }
}
