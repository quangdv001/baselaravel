<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('social_links', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('title');
        //     $table->string('slug');
        //     $table->string('value');
        //     $table->string('en_value');
        //     $table->smallInteger('status')->nullable()->default(1);
        //     $table->integer('admin_id_c')->nullable()->default(0);
        //     $table->string('admin_name_c')->nullable();
        //     $table->integer('admin_id_u')->nullable()->default(0);
        //     $table->string('admin_name_u')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_links');
    }
}
