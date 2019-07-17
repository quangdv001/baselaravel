<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img')->nullable();
            $table->smallInteger('status')->nullable()->default(1);
            $table->integer('category_id')->nullable()->default(0);
            $table->integer('admin_id_c')->nullable()->default(0);
            $table->string('admin_name_c')->nullable();
            $table->integer('admin_id_u')->nullable()->default(0);
            $table->string('admin_name_u')->nullable();
            $table->timestamps();
        });
        // Schema::disableForeignKeyConstraints();
        Schema::create('article_translation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('article_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('meta')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unique(['article_id', 'locale']);
            $table->foreign('article_id')->references('id')->on('article')->onDelete('cascade');
        });
        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('article');
        Schema::dropIfExists('article_translation');
        // Schema::enableForeignKeyConstraints();
    }
}
