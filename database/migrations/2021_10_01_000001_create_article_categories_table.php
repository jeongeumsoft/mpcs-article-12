<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable()->index();
            $table->integer('order')->default(0);
            $table->string('name', 100);
            $table->string('slug', 100)->index();
            $table->text('description')->nullable();
            $table->tinyInteger('type')->unsigned()->default(1);
            $table->boolean('is_visible')->default(0);
            $table->unsignedTinyInteger('depth')->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
