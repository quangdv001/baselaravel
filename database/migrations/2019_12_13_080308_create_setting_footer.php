<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingFooter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_footer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('type')->default(0);
            $table->smallInteger('parent_id')->default(0);
            $table->smallInteger('position')->default(0);
            $table->text('content');
            $table->text('social')->nullable();
            $table->string('img')->nullable();
            $table->smallInteger('single_page_id')->default(0);
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('posts');
    }
}
