<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_footer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->text('value')->nullable();
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
        Schema::dropIfExists('config_footer');
    }
}
