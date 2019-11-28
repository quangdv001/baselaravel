<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('img')->nullable();
            $table->string('type_name')->nullable();
            $table->integer('acreage')->nullable()->default(0);
            $table->string('direction')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('status')->nullable()->default(1);
            $table->string('address')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->integer('category_id')->nullable()->default(0);
            $table->string('province_id')->nullable()->default('');
            $table->string('district_id')->nullable()->default('');
            $table->string('ward_id')->nullable()->default('');
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
        Schema::dropIfExists('room');
    }
}
